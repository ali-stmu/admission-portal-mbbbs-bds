<div class="card shadow-sm border-0">

    <style>
        .term-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .term-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
            border-color: var(--bs-primary);
        }

        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.1em;
        }

        .form-check-input:checked {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }
    </style>
    <div class="card-header bg-primary text-white rounded-top">
        <h4 class="mb-0">Select Admission Term</h4>
    </div>
    <div class="card-body p-4">
        @if ($terms->isEmpty())
            <div class="alert alert-danger rounded">
                No admission terms are currently open. Please check back later.
            </div>
        @else
            <div class="mb-4">
                <p class="lead text-muted">Select your preferred admission term:</p>

                <div class="row g-3">
                    @foreach ($terms as $term)
                        @php
                            $startDate = \Carbon\Carbon::parse($term->start_date)->format('M j, Y');
                            $endDate = \Carbon\Carbon::parse($term->end_date)->format('M j, Y');
                        @endphp
                        <div class="col-md-6">
                            <div class="card term-card h-100 border-0 shadow-sm">
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="form-check">
                                            <input type="radio" id="term_{{ $term->id }}" name="selectedTerm"
                                                wire:model="selectedTerm" value="{{ $term->id }}"
                                                class="form-check-input">
                                        </div>
                                        <label for="term_{{ $term->id }}" class="form-check-label ms-3">
                                            <h5 class="mb-0 text-primary">{{ $term->name }}</h5>
                                        </label>
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge bg-light text-dark">{{ $term->session }}</span>
                                    </div>
                                    <div class="text-muted mb-3">
                                        <i class="far fa-calendar-alt me-2"></i>
                                        {{ $startDate }} - {{ $endDate }}
                                    </div>
                                    @if ($term->description)
                                        <div class="mt-auto">
                                            <p class="small text-muted mb-0">{{ $term->description }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @error('selectedTerm')
                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button wire:click="proceed" class="btn btn-primary px-4 py-2 rounded-pill d-flex align-items-center"
                    @if ($hasSubmittedApplication) disabled @endif>
                    Proceed to Application
                    <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>

            @if ($hasSubmittedApplication)
                <div class="alert alert-info rounded mt-4">
                    <i class="fas fa-info-circle me-2"></i>
                    You have already submitted an application. Editing is not allowed after submission.
                </div>
            @endif
        @endif
    </div>
</div>
