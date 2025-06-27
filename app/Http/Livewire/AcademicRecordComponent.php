<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AcademicRecord;
use App\Models\Student;

class AcademicRecordComponent extends Component
{
    public $studentId;
    public $matricRecords = [
        'school' => '',
        'board' => '',
        'year' => '',
        'result_status' => 'declared',
        'maximum_marks' => '',
        'obtained_marks' => '',
        'percentage' => '',
    ];
    
    public $intermediateRecords = [
        'school_college' => '',
        'board' => '',
        'year' => '',
        'result_status' => 'declared',
        'maximum_marks' => '',
        'obtained_marks' => '',
        'percentage' => '',
    ];

    protected function rules()
    {
        return [
            'matricRecords.school' => 'required|string|max:255',
            'matricRecords.board' => 'required|string|max:100',
            'matricRecords.year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'matricRecords.result_status' => 'required|in:declared,awaited',
            'matricRecords.maximum_marks' => 'required|integer|min:1',
            'matricRecords.obtained_marks' => 'required|integer|min:0|lte:matricRecords.maximum_marks',
            'matricRecords.percentage' => 'required|numeric|min:0|max:100',
            
            'intermediateRecords.school_college' => 'required|string|max:255',
            'intermediateRecords.board' => 'required|string|max:100',
            'intermediateRecords.year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'intermediateRecords.result_status' => 'required|in:declared,awaited',
            'intermediateRecords.maximum_marks' => 'required|integer|min:1',
            'intermediateRecords.obtained_marks' => 'required|integer|min:0|lte:intermediateRecords.maximum_marks',
            'intermediateRecords.percentage' => 'required|numeric|min:0|max:100',
        ];
    }

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        
        // Load existing records if they exist
        $matricRecord = AcademicRecord::where('student_id', $studentId)
            ->where('level', 'matric')
            ->first();
            
        $intermediateRecord = AcademicRecord::where('student_id', $studentId)
            ->where('level', 'intermediate')
            ->first();
            
        if ($matricRecord) {
            $this->matricRecords = [
                'school' => $matricRecord->school_college,
                'board' => $matricRecord->board,
                'year' => $matricRecord->year,
                'result_status' => $matricRecord->result_status,
                'maximum_marks' => $matricRecord->maximum_marks,
                'obtained_marks' => $matricRecord->obtained_marks,
                'percentage' => $matricRecord->percentage,
            ];
        }
        
        if ($intermediateRecord) {
            $this->intermediateRecords = [
                'school_college' => $intermediateRecord->school_college,
                'board' => $intermediateRecord->board,
                'year' => $intermediateRecord->year,
                'result_status' => $intermediateRecord->result_status,
                'maximum_marks' => $intermediateRecord->maximum_marks,
                'obtained_marks' => $intermediateRecord->obtained_marks,
                'percentage' => $intermediateRecord->percentage,
            ];
        }
    }

    public function calculatePercentage($level)
    {
        if ($level === 'matric') {
            if ($this->matricRecords['maximum_marks'] && $this->matricRecords['obtained_marks']) {
                $this->matricRecords['percentage'] = round(($this->matricRecords['obtained_marks'] / $this->matricRecords['maximum_marks']) * 100, 2);
            }
        } else {
            if ($this->intermediateRecords['maximum_marks'] && $this->intermediateRecords['obtained_marks']) {
                $this->intermediateRecords['percentage'] = round(($this->intermediateRecords['obtained_marks'] / $this->intermediateRecords['maximum_marks']) * 100, 2);
            }
        }
    }

    public function save()
    {
        $this->validate($this->rules());

        // Update or create matric records
        AcademicRecord::updateOrCreate(
            [
                'student_id' => $this->studentId,
                'level' => 'matric'
            ],
            [
                'school_college' => $this->matricRecords['school'],
                'board' => $this->matricRecords['board'],
                'year' => $this->matricRecords['year'],
                'result_status' => $this->matricRecords['result_status'],
                'maximum_marks' => $this->matricRecords['maximum_marks'],
                'obtained_marks' => $this->matricRecords['obtained_marks'],
                'percentage' => $this->matricRecords['percentage'],
            ]
        );

        // Update or create intermediate records
        AcademicRecord::updateOrCreate(
            [
                'student_id' => $this->studentId,
                'level' => 'intermediate'
            ],
            [
                'school_college' => $this->intermediateRecords['school_college'],
                'board' => $this->intermediateRecords['board'],
                'year' => $this->intermediateRecords['year'],
                'result_status' => $this->intermediateRecords['result_status'],
                'maximum_marks' => $this->intermediateRecords['maximum_marks'],
                'obtained_marks' => $this->intermediateRecords['obtained_marks'],
                'percentage' => $this->intermediateRecords['percentage'],
            ]
        );

        $this->dispatch('academicRecordsSaved', studentId: $this->studentId);
    }

    public function render()
    {
        return view('livewire.academic-record-component');
    }
}