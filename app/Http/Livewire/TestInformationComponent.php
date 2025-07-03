<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TestInformation;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class TestInformationComponent extends Component
{
    use WithFileUploads;

    public $studentId;
    public $testType = 'stmu';
    public $testCenter;
    public $testName;
    public $testScore;
    public $testDocument;
    public $existingDocumentPath;
    public $isInternational = true;
    public $testYear;
    public $resultStatus = 'declared'; // default value

    public $testCenters = [
        'Islamabad', 'Rawalpindi', 'Karachi', 'Lahore',
        'Peshawar', 'Quetta', 'Multan', 'Faisalabad'
    ];

    protected function rules()
    {
        $rules = [
            'testType' => 'required|in:stmu,mdcat,sat-ii,foreign-mcat,ucat,other',
        ];

        // Only require test center for STMU
        if ($this->testType === 'stmu') {
            $rules['testCenter'] = 'required|string|max:100';
        } else {
            // For other test types
            $rules['testCenter'] = 'nullable|string|max:100';
            $rules['testName'] = 'required_if:testType,other|nullable|string|max:255';
            $rules['testYear'] = 'required|digits:4|integer|min:2000|max:' . date('Y');
            $rules['resultStatus'] = 'required|in:awaited,declared';
            $rules['testDocument'] = 'required_if:testType,mdcat,sat-ii,foreign-mcat,ucat,other|nullable|file|mimes:pdf,jpg,png|max:2048';
        }

        // If result is declared (and not STMU), then testScore is required
        if ($this->resultStatus === 'declared' && $this->testType !== 'stmu') {
            $rules['testScore'] = 'required|numeric|min:0|max:1000';
        } else {
            $rules['testScore'] = 'nullable|numeric|min:0|max:1000';
        }

        return $rules;
    }

    public function mount($studentId)
    {
        $this->studentId = $studentId;

        $user = auth()->user();
        $this->isInternational = strtolower($user->nationality) !== 'local';

        $existingTest = TestInformation::where('student_id', $studentId)->first();

        if ($existingTest) {
            $this->testType = $existingTest->test_type;
            $this->testCenter = $existingTest->test_center;
            $this->testName = $existingTest->test_name;
            $this->testScore = $existingTest->test_score;
            $this->testYear = $existingTest->test_year;
            $this->resultStatus = $existingTest->result_status ?? 'declared';
            $this->existingDocumentPath = $existingTest->test_document_path;
        }
    }

    public function save()
    {
        $this->validate();

        $testDocumentPath = $this->existingDocumentPath;

        // Only handle document upload if not STMU
        if ($this->testType !== 'stmu') {
            if ($this->testDocument) {
                if ($this->existingDocumentPath && Storage::disk('public')->exists($this->existingDocumentPath)) {
                    Storage::disk('public')->delete($this->existingDocumentPath);
                }
                $testDocumentPath = $this->testDocument->store('test-documents', 'public');
            } elseif (empty($this->existingDocumentPath)) {
                $requiredTypes = ['mdcat', 'sat-ii', 'foreign-mcat', 'ucat', 'other'];
                if (in_array($this->testType, $requiredTypes)) {
                    $this->addError('testDocument', 'A document is required for this test type.');
                    return;
                }
            }
        }

        TestInformation::updateOrCreate(
            ['student_id' => $this->studentId],
            [
                'test_type' => $this->testType,
                'test_center' => $this->testCenter,
                'test_name' => $this->testName,
                'test_score' => $this->testType === 'stmu' ? null : $this->testScore,
                'test_year' => $this->testType === 'stmu' ? null : $this->testYear,
                'result_status' => $this->testType === 'stmu' ? null : $this->resultStatus,
                'test_document_path' => $this->testType === 'stmu' ? null : $testDocumentPath,
            ]
        );

        $this->dispatch('testInformationSaved', studentId: $this->studentId);
        $this->reset('testDocument');
    }

    public function removeDocument()
    {
        if ($this->existingDocumentPath && Storage::disk('public')->exists($this->existingDocumentPath)) {
            Storage::disk('public')->delete($this->existingDocumentPath);
        }

        $this->existingDocumentPath = null;
        $this->testDocument = null;

        TestInformation::where('student_id', $this->studentId)
            ->update(['test_document_path' => null]);
    }

    public function render()
    {
        return view('livewire.test-information-component');
    }
}
