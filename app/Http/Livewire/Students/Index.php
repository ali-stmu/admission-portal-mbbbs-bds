<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use App\Models\PaymentInformation;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentVerifiedMail;
use App\Mail\PaymentDiscardedMail;


class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $payment, $showPaymentModal = false, $showDiscardForm = false, $discardRemarks = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $students = Student::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('application_no', 'like', '%' . $this->search . '%')
            ->orWhere('cnic', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.students.index', [
            'students' => $students
        ]);
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

