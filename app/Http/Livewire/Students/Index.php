<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use App\Models\PaymentInformation;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentVerifiedMail;
use App\Mail\PaymentDiscardedMail;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Log; // Import the Facade



class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $payment, $showPaymentModal = false, $showDiscardForm = false, $discardRemarks = '';
    public $programFilter = '';
    public $intlProgramFilter = '';
    public $specialProgramFilter = '';
    public $searchPerformed = false;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }
 public function performSearch()
    {
        $this->searchPerformed = true;
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->searchPerformed = false;
        $this->resetPage();
    }
public function render()
{
    $studentsQuery = Student::query()->with('paymentInformation');

    // Apply search only if search was performed and search term exists
    if ($this->searchPerformed && !empty($this->search)) {
        $studentsQuery->where(function($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('application_no', 'like', '%' . $this->search . '%')
                  ->orWhere('cnic', 'like', '%' . $this->search . '%');
        });
    }

    // Apply program filters
    if (!empty($this->programFilter)) {
        $studentsQuery->whereHas('paymentInformation', function ($query) {
            $query->where('program', $this->programFilter)
                  ->orWhere('local_program', $this->programFilter);
        });
    }

    if (!empty($this->intlProgramFilter)) {
        $studentsQuery->whereHas('paymentInformation', function ($query) {
            $query->where('intl_program', 'intl_' . strtolower($this->intlProgramFilter));
        });
    }

    if (!empty($this->specialProgramFilter)) {
        $studentsQuery->whereHas('paymentInformation', function ($query) {
            $query->where('special_program', 'special_' . strtolower($this->specialProgramFilter));
        });
    }

    // 🔹 Order: Not Verified first, then Verified, then by newest student
    $students = $studentsQuery
        ->leftJoin('payment_informations', 'students.id', '=', 'payment_informations.student_id')
        ->select('students.*') // avoid duplicate columns
        ->orderByRaw('
            CASE 
                WHEN payment_informations.payment_verified = 0 THEN 0 
                ELSE 1 
            END ASC
        ')
        ->orderBy('students.id', 'desc')
        ->paginate($this->perPage);

    return view('livewire.students.index', [
        'students' => $students
    ]);
}

public function updatedProgramFilter()
{
    $this->resetPage();
}
public function updatedIntlProgramFilter()
{
    $this->resetPage();
}

public function updatedSpecialProgramFilter()
{
    $this->resetPage();
}

    public function viewPayment($studentId)
{
    $this->payment = PaymentInformation::where('student_id', $studentId)->first();
    $this->showPaymentModal = true;
    $this->showDiscardForm = false;
    $this->discardRemarks = '';
}

public function verifyPayment($paymentId)
{
    $payment = PaymentInformation::findOrFail($paymentId);
    $payment->payment_verified = 1;
    $payment->save();

    $student = $payment->student;

    // Send email
    Mail::to($student->email)->send(new PaymentVerifiedMail($student->application_no, $payment->program));

    $this->showPaymentModal = false;
    session()->flash('message', 'Payment verified and email sent to applicant.');
}
public function downloadExcel(): StreamedResponse
{
    $userEmail = auth()->user()->email; // get logged-in email

    // Decide which programs to include based on email
    $allowedPrograms = [];
    if ($userEmail === 'adminscm@stmu.edu.pk') {
        $allowedPrograms = ['both', 'mbbs'];
    } elseif ($userEmail === 'adminscd@stmu.edu.pk') {
        $allowedPrograms = ['both', 'scd'];
    } else {
        // default: allow all
        $allowedPrograms = ['both', 'mbbs', 'bds', 'scd'];
    }

    // Fetch students with payment info + test info
    $students = Student::with(['paymentInformation', 'testInformation'])->get();

    // Filter students
    $filteredStudents = $students->filter(function ($student) use ($allowedPrograms) {
        $paymentInfo = $student->paymentInformation;

        if (!$paymentInfo || $paymentInfo->payment_verified != 1) {
            return false;
        }

        $program = $paymentInfo->program ?? null;
        if (!$program) {
            return false;
        }

        // If plain string program
        if (is_string($program) && !$this->isJson($program)) {
            return in_array(strtolower($program), $allowedPrograms);
        }

        // If JSON string program
        if (is_string($program) && $this->isJson($program)) {
            $decoded = json_decode($program, true);
            return isset($decoded['local']) && in_array(strtolower($decoded['local']), $allowedPrograms);
        }

        return false;
    });

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="students.csv"',
    ];

    return response()->stream(function () use ($filteredStudents) {
        $handle = fopen('php://output', 'w');

        // Excel Header Row
        fputcsv($handle, [
            'Application ID / Unique ID',
            'Applicant’s Name',
            'CNIC Number',
            'Email Address',
            'Gender',
            'Father’s Name',
            'Passport Sized Picture (Image URL)',
            'Desired Discipline (MBBS / BDS / Both)',
            'Selected City - Test Center',
            'Applicant’s Primary Contact Number',
            'Applicant’s Secondary Contact Number',
            'Current Postal Address',
        ]);

        // Data Rows
        foreach ($filteredStudents as $student) {
            $program = $student->paymentInformation->program ?? null;
            $category = 'N/A';

            if ($program) {
                if (is_string($program) && !$this->isJson($program)) {
                    $category = strtolower($program);
                } elseif (is_string($program) && $this->isJson($program)) {
                    $decoded = json_decode($program, true);
                    if (isset($decoded['local'])) {
                        $category = $program;
                    }
                }
            }

            fputcsv($handle, [
                $student->application_no,
                $student->name,
                $student->cnic,
                $student->email,
                $student->gender,
                $student->father_name,
                $student->photo_path ? asset('storage/' . $student->photo_path) : 'N/A',
                $category,
                $student->testInformation->test_center ?? 'N/A',
                $student->mobile,
                $student->father_mobile,
                $student->mailing_address ?? 'N/A',
            ]);
        }

        fclose($handle);
    }, 200, $headers);
}




private function isJson($string): bool
{
    json_decode($string);
    return (json_last_error() === JSON_ERROR_NONE);
}
public function getProgramOptionsProperty()
{
    $options = [
        'local' => [
            '' => 'All Local Programs',
            'BDS' => 'BDS',
            'both' => 'both'
        ],
        'intl' => [
            '' => 'All Foreign Programs',
            'BDS' => 'Foreign BDS',
            'both' => 'Foreign both'
        ],
        'special' => [
            '' => 'All Special Programs',
            'BDS' => 'Special Foreign BDS',
            'both' => 'Special Foreign both'
        ]
    ];
    
    $userEmail = auth()->user()->email;
    
    // Remove BDS options if user is adminscm@stmu.edu.pk
    if ($userEmail === 'adminscm@stmu.edu.pk') {
        unset($options['local']['BDS']);
        unset($options['intl']['BDS']);
        unset($options['special']['BDS']);
    }
    
    // Add MBBS options if user is not adminscd@stmu.edu.pk
    if ($userEmail !== 'adminscd@stmu.edu.pk') {
        $options['local']['MBBS'] = 'MBBS';
        $options['intl']['MBBS'] = 'Foreign MBBS';
        $options['special']['MBBS'] = 'Special Foreign MBBS';
    }
    
    return $options;
}

public function discardPayment($paymentId)
{
    $payment = PaymentInformation::findOrFail($paymentId);
    $payment->payment_verified = 0;
    $payment->discard_remarks = $this->discardRemarks;
    $payment->save();

    $student = $payment->student;
    $student->is_submitted = 0;
    $student->save();

    // Send discard email
    Mail::to($student->email)->send(new PaymentDiscardedMail(
        $student->application_no,
        $payment->program,
        $this->discardRemarks
    ));

    $this->showDiscardForm = false;
    $this->showPaymentModal = false;
    $this->discardRemarks = '';
    session()->flash('message', 'Payment discarded and email sent to applicant.');
}

}

