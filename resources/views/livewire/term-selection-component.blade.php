<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Select Admission Term</h4>
    </div>
    <div class="card-body">
        @if ($terms->isEmpty())
            <div class="alert alert-danger">
                No admission terms are currently open. Please check back later.
            </div>
        @else
            <div class="mb-4">
                <p class="lead">Please select the term for which you are applying:</p>

                <div class="list-group">
                    @foreach ($terms as $term)
                        <label class="list-group-item">
                            <input type="radio" name="selectedTerm" wire:model="selectedTerm"
                                value="{{ $term->id }}" class="form-check-input me-2">
                            <strong>{{ $term->name }}</strong> - {{ $term->session }}
                            <br>
                            <small class="text-muted">
                                {{ $term->start_date }} to {{ $term->end_date }}
                            </small>
                            @if ($term->description)
                                <div class="mt-2">{{ $term->description }}</div>
                            @endif
                        </label>
                    @endforeach
                </div>

                @error('selectedTerm')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button wire:click="proceed" class="btn btn-primary" @if ($hasSubmittedApplication) disabled @endif>
                Proceed to Application <i class="fas fa-arrow-right ms-2"></i>
            </button>

            @if ($hasSubmittedApplication)
                <div class="alert alert-info mt-3">
                    You have already submitted an application. Editing is not allowed after submission.
                </div>
            @endif
        @endif
    </div>
</div>
