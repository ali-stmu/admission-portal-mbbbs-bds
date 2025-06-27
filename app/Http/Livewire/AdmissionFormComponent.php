<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdmissionFormComponent extends Component
{
    public $currentStep = 1;
    public $termId;
    public $studentId;
    
    protected $listeners = [
        'termSelected',
        'personalProfileSaved',
        'academicRecordsSaved',
        'testInformationSaved',
        'paymentInformationSaved',
        'previousStep'
    ];

    public function render()
    {
        return view('livewire.admission-form-component');
    }

    public function termSelected($termId)
    {
        $this->termId = $termId;
        $this->currentStep = 2;
    }

    public function personalProfileSaved($studentId)
    {
        $this->studentId = $studentId;
        $this->currentStep = 3;
    }

    public function academicRecordsSaved($studentId)
    {
        $this->studentId = $studentId;
        $this->currentStep = 4;
    }

    public function testInformationSaved($studentId)
    {
        $this->studentId = $studentId;
        $this->currentStep = 5;
    }

    public function paymentInformationSaved($studentId)
    {
        $this->studentId = $studentId;
        $this->currentStep = 6;
    }
    public function mount()
{
    // If there's a studentId in session, check if already submitted
    if ($this->studentId) {
        $student = Student::find($this->studentId);
        if ($student && $student->is_submitted) {
            $this->currentStep = 6; // Skip to completion if already submitted
        }
    }
}

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }
}