<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TestInformation;
use App\Models\Student;

class TestInformationComponent extends Component
{
    use WithFileUploads;

    public $studentId;
    public $testType = 'stmu';
    public $testCenter;
    public $testName;
    public $testScore;
    public $testDocument;
    
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
    }

    public function save()
    {
        $this->validate();

        $testDocumentPath = null;
        if ($this->testDocument) {
            $testDocumentPath = $this->testDocument->store('test-documents', 'public');
        }

        TestInformation::create([
            'student_id' => $this->studentId,
            'test_type' => $this->testType,
            'test_center' => $this->testCenter,
            'test_name' => $this->testName,
            'test_score' => $this->testScore,
            'test_document_path' => $testDocumentPath,
        ]);

       $this->dispatch('testInformationSaved', studentId: $this->studentId);
    }

    public function render()
    {
        return view('livewire.test-information-component');
    }
}