<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Student;
use App\Models\AcademicRecord;
use App\Models\TestInformation;

class Edit extends Component
{
    use WithFileUploads;

    public Student $student;
    public $photo, $cnic_copy, $passport_copy;

    public $academicRecords = [];
    public $testInformation;
    public $test_document;

    protected function rules()
    {
        return [
            'student.name' => 'required|string|max:255',
            'student.cnic' => 'required|string|max:15',
            'student.email' => 'required|email',
            'student.mobile' => 'required',
            'student.father_name' => 'nullable',

            'testInformation.test_type' => 'nullable|string|max:255',
            'testInformation.test_center' => 'nullable|string|max:255',
            'testInformation.test_name' => 'nullable|string|max:255',
            'testInformation.test_score' => 'nullable|numeric',

            // Dynamic validation for academic records
            'academicRecords.*.level' => 'nullable|string|max:255',
            'academicRecords.*.school_college' => 'nullable|string|max:255',
            'academicRecords.*.board' => 'nullable|string|max:255',
            'academicRecords.*.year' => 'nullable|integer',
            'academicRecords.*.result_status' => 'nullable|string',
            'academicRecords.*.maximum_marks' => 'nullable|numeric',
            'academicRecords.*.obtained_marks' => 'nullable|numeric',
            'academicRecords.*.percentage' => 'nullable|numeric',
        ];
    }

    public function mount(Student $student)
    {
        $this->student = $student;
        $this->academicRecords = $student->academicRecords()->get()->toArray();
        $this->testInformation = $student->testInformation()->firstOrNew([]);
    }

    public function update()
    {
        $this->validate();

        if ($this->photo) {
            $this->student->photo_path = $this->photo->store('students/photos', 'public');
        }

        if ($this->cnic_copy) {
            $this->student->cnic_copy_path = $this->cnic_copy->store('students/cnic_copies', 'public');
        }

        if ($this->passport_copy) {
            $this->student->passport_copy_path = $this->passport_copy->store('students/passport_copies', 'public');
        }

        if ($this->test_document) {
            $this->testInformation->test_document_path = $this->test_document->store('students/tests', 'public');
        }

        $this->student->save();
        $this->testInformation->student_id = $this->student->id;
        $this->testInformation->save();

        // Update academic records
        foreach ($this->academicRecords as $index => $record) {
            if (isset($record['id'])) {
                $academic = AcademicRecord::find($record['id']);
                if (isset($record['attachment']) && is_object($record['attachment'])) {
            $path = $record['attachment']->store('academic_records', 'public');
            $record['attachment'] = $path;
        }
                if ($academic) {
                    $academic->update($record);
                }
            }
        }

        session()->flash('message', 'Student & related records updated!');
        return redirect()->route('students.index');
    }
    public function updatedAcademicRecords($value, $key)
{
    // Parse $key like '2.obtained_marks' or '1.maximum_marks'
    [$index, $field] = explode('.', $key);

    // Check if both values are available for calculation
    $record = $this->academicRecords[$index];

    if (!empty($record['obtained_marks']) && !empty($record['maximum_marks']) && $record['maximum_marks'] > 0) {
        $this->academicRecords[$index]['percentage'] =
            round(($record['obtained_marks'] / $record['maximum_marks']) * 100, 2);
    }
}


    public function render()
    {
        return view('livewire.students.edit');
    }
}
