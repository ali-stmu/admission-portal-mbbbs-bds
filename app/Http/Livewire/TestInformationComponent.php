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
    
    public $testCenters = [
        'Islamabad',
        'Rawalpindi',
        'Karachi',
        'Lahore',
        'Peshawar',
        'Quetta',
        'Multan',
        'Faisalabad'
    ];

    protected $rules = [
        'testType' => 'required|in:stmu,mdcat,sat-ii,foreign-mcat,ucat,other',
        'testCenter' => 'required_if:testType,stmu|nullable|string|max:100',
        'testName' => 'required_if:testType,other|nullable|string|max:255',
        'testScore' => 'nullable|numeric|min:0|max:1000',
        'testDocument' => 'required_if:testType,mdcat,sat-ii,foreign-mcat,ucat,other|nullable|file|mimes:pdf,jpg,png|max:2048',
    ];

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        
        // Load existing test information if it exists
        $existingTest = TestInformation::where('student_id', $studentId)->first();
        
        if ($existingTest) {
            $this->testType = $existingTest->test_type;
            $this->testCenter = $existingTest->test_center;
            $this->testName = $existingTest->test_name;
            $this->testScore = $existingTest->test_score;
            $this->existingDocumentPath = $existingTest->test_document_path;
        }
    }

    public function save()
    {
        $this->validate();

        $testDocumentPath = $this->existingDocumentPath;
        
        // Only process new file upload if a file was provided
        if ($this->testDocument) {
            // Delete old file if it exists
            if ($this->existingDocumentPath && Storage::disk('public')->exists($this->existingDocumentPath)) {
                Storage::disk('public')->delete($this->existingDocumentPath);
            }
            $testDocumentPath = $this->testDocument->store('test-documents', 'public');
        } elseif (empty($this->existingDocumentPath)) {
            // If no existing document and no new document provided for types that require it
            $requiredTypes = ['mdcat', 'sat-ii', 'foreign-mcat', 'ucat', 'other'];
            if (in_array($this->testType, $requiredTypes)) {
                $this->addError('testDocument', 'A document is required for this test type.');
                return;
            }
        }

        // Update or create test information
        TestInformation::updateOrCreate(
            ['student_id' => $this->studentId],
            [
                'test_type' => $this->testType,
                'test_center' => $this->testCenter,
                'test_name' => $this->testName,
                'test_score' => $this->testScore,
                'test_document_path' => $testDocumentPath,
            ]
        );

        $this->dispatch('testInformationSaved', studentId: $this->studentId);
        
        // Reset the file input after successful save
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