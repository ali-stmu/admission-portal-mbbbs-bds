<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AcademicRecord;
use Illuminate\Support\Facades\Storage;

class AcademicRecordComponent extends Component
{
    use WithFileUploads;

    public $studentId;

    public $matricRecords = [
        'school' => '',
        'board' => '',
        'year' => '',
        'result_status' => 'declared',
        'maximum_marks' => null,
        'obtained_marks' => null,
        'percentage' => null,
    ];

    public $intermediateRecords = [
        'school_college' => '',
        'board' => '',
        'year' => '',
        'result_status' => 'declared',
        'maximum_marks' => null,
        'obtained_marks' => null,
        'percentage' => null,
    ];

    public $matricAttachment;
    public $intermediateAttachment;

    protected function rules()
    {
        $rules = [
            'matricRecords.school' => 'required|string|max:255',
            'matricRecords.board' => 'required|string|max:100',
            'matricRecords.year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'matricRecords.result_status' => 'required|in:declared,awaited',
            'intermediateRecords.school_college' => 'required|string|max:255',
            'intermediateRecords.board' => 'required|string|max:100',
            'intermediateRecords.year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'intermediateRecords.result_status' => 'required|in:declared,awaited',
        ];

        if ($this->matricRecords['result_status'] === 'declared') {
            $rules = array_merge($rules, [
                'matricRecords.maximum_marks' => 'required|integer|min:1',
                'matricRecords.obtained_marks' => 'required|integer|min:0|lte:matricRecords.maximum_marks',
                'matricRecords.percentage' => 'required|numeric|min:0|max:100',
                'matricAttachment' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
        }

        if ($this->intermediateRecords['result_status'] === 'declared') {
            $rules = array_merge($rules, [
                'intermediateRecords.maximum_marks' => 'required|integer|min:1',
                'intermediateRecords.obtained_marks' => 'required|integer|min:0|lte:intermediateRecords.maximum_marks',
                'intermediateRecords.percentage' => 'required|numeric|min:0|max:100',
                'intermediateAttachment' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
        }

        return $rules;
    }

    public function mount($studentId)
    {
        $this->studentId = $studentId;

        $matricRecord = AcademicRecord::where('student_id', $studentId)->where('level', 'matric')->first();
        $intermediateRecord = AcademicRecord::where('student_id', $studentId)->where('level', 'intermediate')->first();

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
        $this->validate();

        $matricAttachmentPath = null;
        $intermediateAttachmentPath = null;

        if ($this->matricRecords['result_status'] === 'declared' && $this->matricAttachment) {
            $matricAttachmentPath = $this->matricAttachment->store('attachments/matric', 'public');
        }

        if ($this->intermediateRecords['result_status'] === 'declared' && $this->intermediateAttachment) {
            $intermediateAttachmentPath = $this->intermediateAttachment->store('attachments/intermediate', 'public');
        }

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
                'maximum_marks' => $this->matricRecords['result_status'] === 'declared' ? $this->matricRecords['maximum_marks'] : 0,
                'obtained_marks' => $this->matricRecords['result_status'] === 'declared' ? $this->matricRecords['obtained_marks'] : 0,
                'percentage' => $this->matricRecords['result_status'] === 'declared' ? $this->matricRecords['percentage'] : 0,
                'attachment' => $matricAttachmentPath,
            ]
        );

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
                'maximum_marks' => $this->intermediateRecords['result_status'] === 'declared' ? $this->intermediateRecords['maximum_marks'] : 0,
                'obtained_marks' => $this->intermediateRecords['result_status'] === 'declared' ? $this->intermediateRecords['obtained_marks'] : 0,
                'percentage' => $this->intermediateRecords['result_status'] === 'declared' ? $this->intermediateRecords['percentage'] : 0,
                'attachment' => $intermediateAttachmentPath,
            ]
        );

        $this->dispatch('academicRecordsSaved', studentId: $this->studentId);
    }

    public function render()
    {
        return view('livewire.academic-record-component');
    }
}
