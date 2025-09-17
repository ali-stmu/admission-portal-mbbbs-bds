<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class ApplicationCompleteComponent extends Component
{
    public $studentId;
    public $student;

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->student = $this->getSanitizedStudent($studentId);
    }

    public function downloadPdf()
    {
        $pdf = $this->generatePdf();
        return $pdf->download('application_'.$this->student->application_no.'.pdf');
    }

    public function printApplication()
    {
        $pdf = $this->generatePdf();
        return $pdf->stream('application_'.$this->student->application_no.'.pdf');
    }

    protected function generatePdf()
    {
        $html = view('pdf.application', ['student' => $this->student])->render();
        
        // Ensure proper UTF-8 encoding
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        
        return Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOption('defaultFont', 'dejavu sans')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);
    }

    protected function getSanitizedStudent($studentId)
    {
        $student = Student::with(['term', 'academicRecords', 'testInformation', 'paymentInformation'])
                        ->findOrFail($studentId);
        
        // Convert all string fields to proper UTF-8
        $this->sanitizeModel($student);
        
        if ($student->term) {
            $this->sanitizeModel($student->term);
        }
        
        if ($student->paymentInformation) {
            $this->sanitizeModel($student->paymentInformation);
        }
        
        if ($student->academicRecords) {
            foreach ($student->academicRecords as $record) {
                $this->sanitizeModel($record);
            }
        }
        
        if ($student->testInformation) {
            $this->sanitizeModel($student->testInformation);
        }
        
        return $student;
    }

    protected function sanitizeModel($model)
    {
        foreach ($model->getAttributes() as $key => $value) {
            if (is_string($value)) {
                $model->$key = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
            }
        }
    }

    public function render()
    {
        return view('livewire.application-complete-component');
    }
}