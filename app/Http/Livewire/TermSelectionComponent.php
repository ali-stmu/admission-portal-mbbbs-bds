<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Term;

class TermSelectionComponent extends Component
{
    public $terms;
    public $selectedTerm;

    public function mount()
    {
        $this->terms = Term::where('is_active', true)->get();
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