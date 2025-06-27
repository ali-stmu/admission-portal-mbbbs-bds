<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

use Livewire\Component;
use App\Models\Term;

class TermSelectionComponent extends Component
{
    public $terms;
    public $selectedTerm;
public $hasSubmittedApplication = false;
 public function mount()
    {
        $this->terms = Term::where('is_active', true)->get();
        
        // Check if user already has a submitted application
        if (Auth::check()) {
            $user = Auth::user();
            $this->hasSubmittedApplication = Student::where('user_id', $user->id)
                ->where('is_submitted', true)
                ->exists();
        }
    }

    public function render()
    {
        return view('livewire.term-selection-component');
    }

public function proceed()
{
    if (!$this->selectedTerm) {
        $this->addError('selectedTerm', 'Please select a term to proceed');
        return;
    }

    // Change from emit() to dispatch()
    $this->dispatch('termSelected', termId: $this->selectedTerm);
}
}