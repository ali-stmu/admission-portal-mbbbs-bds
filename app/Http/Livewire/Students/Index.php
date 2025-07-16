<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $students = Student::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('application_no', 'like', '%' . $this->search . '%')
            ->orWhere('cnic', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.students.index', [
            'students' => $students
        ]);
    }
}

