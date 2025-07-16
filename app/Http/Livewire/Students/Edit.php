<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Student;

class Edit extends Component
{
    use WithFileUploads;

    public Student $student;

    public $photo, $cnic_copy, $passport_copy;

    protected function rules()
    {
        return [
            'student.name' => 'required|string|max:255',
            'student.cnic' => 'required|string|max:15',
            'student.mobile' => 'required|string|max:20',
            'student.email' => 'required|email',
            'student.father_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:1024',
            'cnic_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'passport_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            // add all other fields as needed
        ];
    }

    public function mount(Student $student)
    {
        $this->student = $student;
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

        $this->student->save();

        session()->flash('message', 'Student record updated successfully!');
        return redirect()->route('students.index');
    }

    public function render()
    {
        return view('livewire.students.edit');
    }
}

