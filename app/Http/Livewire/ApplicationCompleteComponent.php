<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;

class ApplicationCompleteComponent extends Component
{
    public $studentId;
    public $student;

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->student = Student::with(['term', 'academicRecords', 'testInformation', 'paymentInformation'])
                              ->findOrFail($studentId);
    }

    public function render()
    {
        return view('livewire.application-complete-component');
    }
}