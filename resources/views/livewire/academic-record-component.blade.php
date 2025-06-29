<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0 d-flex align-items-center">
            <i class="fas fa-graduation-cap me-2"></i>
            Academic Records
        </h4>
    </div>
    <div class="card-body p-4">
        <form wire:submit.prevent="save">
            <!-- Matriculation Section -->
            <div class="row mb-4 g-4">
                <div class="col-12">
                    <div class="section-header bg-light p-3 rounded">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-certificate me-2"></i>
                            Matriculation / O-levels or equivalent
                        </h5>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- School -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">School</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-school"></i></span>
                            <input type="text"
                                class="form-control @error('matricRecords.school') is-invalid @enderror"
                                wire:model="matricRecords.school" placeholder="Enter school name">
                        </div>
                        @error('matricRecords.school')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Board -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Board</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                            <input type="text"
                                class="form-control @error('matricRecords.board') is-invalid @enderror"
                                wire:model="matricRecords.board" placeholder="e.g., FBISE, Cambridge">
                        </div>
                        @error('matricRecords.board')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Year -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Year</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="number" class="form-control @error('matricRecords.year') is-invalid @enderror"
                                wire:model="matricRecords.year" placeholder="YYYY">
                        </div>
                        @error('matricRecords.year')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Result Status -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Result Status</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="matricResultStatus" id="matricDeclared"
                                wire:model="matricRecords.result_status" value="declared">
                            <label class="btn btn-outline-primary" for="matricDeclared">
                                <i class="fas fa-check-circle me-2"></i> Declared
                            </label>

                            <input type="radio" class="btn-check" name="matricResultStatus" id="matricAwaited"
                                wire:model="matricRecords.result_status" value="awaited">
                            <label class="btn btn-outline-primary" for="matricAwaited">
                                <i class="fas fa-clock me-2"></i> Awaited
                            </label>
                        </div>
                        @error('matricRecords.result_status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Marks Section - Only shown when result is declared -->
                    @if ($matricRecords['result_status'] === 'declared')
                        <div class="marks-container">
                            <!-- Maximum Marks -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Maximum Marks</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-chart-line"></i></span>
                                    <input type="number"
                                        class="form-control @error('matricRecords.maximum_marks') is-invalid @enderror"
                                        wire:model="matricRecords.maximum_marks"
                                        wire:change="calculatePercentage('matric')">
                                </div>
                                @error('matricRecords.maximum_marks')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Obtained Marks -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Obtained Marks</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-star"></i></span>
                                    <input type="number"
                                        class="form-control @error('matricRecords.obtained_marks') is-invalid @enderror"
                                        wire:model="matricRecords.obtained_marks"
                                        wire:change="calculatePercentage('matric')">
                                </div>
                                @error('matricRecords.obtained_marks')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Percentage -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Percentage</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                    <input type="text"
                                        class="form-control @error('matricRecords.percentage') is-invalid @enderror"
                                        wire:model="matricRecords.percentage" readonly>
                                </div>
                                @error('matricRecords.percentage')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Intermediate Section -->
            <div class="row mb-4 g-4">
                <div class="col-12">
                    <div class="section-header bg-light p-3 rounded">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-certificate me-2"></i>
                            Intermediate / A-levels / High School or equivalent
                        </h5>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- College -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">College</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-school"></i></span>
                            <input type="text"
                                class="form-control @error('intermediateRecords.school_college') is-invalid @enderror"
                                wire:model="intermediateRecords.school_college" placeholder="Enter college name">
                        </div>
                        @error('intermediateRecords.school_college')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Board -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Board</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                            <input type="text"
                                class="form-control @error('intermediateRecords.board') is-invalid @enderror"
                                wire:model="intermediateRecords.board" placeholder="e.g., FBISE, Cambridge">
                        </div>
                        @error('intermediateRecords.board')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Year -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Year</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="number"
                                class="form-control @error('intermediateRecords.year') is-invalid @enderror"
                                wire:model="intermediateRecords.year" placeholder="YYYY">
                        </div>
                        @error('intermediateRecords.year')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Result Status -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Result Status</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="intermediateResultStatus"
                                id="intermediateDeclared" wire:model="intermediateRecords.result_status"
                                value="declared">
                            <label class="btn btn-outline-primary" for="intermediateDeclared">
                                <i class="fas fa-check-circle me-2"></i> Declared
                            </label>

                            <input type="radio" class="btn-check" name="intermediateResultStatus"
                                id="intermediateAwaited" wire:model="intermediateRecords.result_status"
                                value="awaited">
                            <label class="btn btn-outline-primary" for="intermediateAwaited">
                                <i class="fas fa-clock me-2"></i> Awaited
                            </label>
                        </div>
                        @error('intermediateRecords.result_status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Marks Section - Only shown when result is declared -->
                    @if ($intermediateRecords['result_status'] === 'declared')
                        <div class="marks-container">
                            <!-- Maximum Marks -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Maximum Marks</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-chart-line"></i></span>
                                    <input type="number"
                                        class="form-control @error('intermediateRecords.maximum_marks') is-invalid @enderror"
                                        wire:model="intermediateRecords.maximum_marks"
                                        wire:change="calculatePercentage('intermediate')">
                                </div>
                                @error('intermediateRecords.maximum_marks')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Obtained Marks -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Obtained Marks</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-star"></i></span>
                                    <input type="number"
                                        class="form-control @error('intermediateRecords.obtained_marks') is-invalid @enderror"
                                        wire:model="intermediateRecords.obtained_marks"
                                        wire:change="calculatePercentage('intermediate')">
                                </div>
                                @error('intermediateRecords.obtained_marks')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Percentage -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Percentage</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                    <input type="text"
                                        class="form-control @error('intermediateRecords.percentage') is-invalid @enderror"
                                        wire:model="intermediateRecords.percentage" readonly>
                                </div>
                                @error('intermediateRecords.percentage')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary px-4 py-2 rounded-pill"
                    wire:click="$dispatch('previousStep')">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </button>
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                    Save & Continue <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </form>
    </div>
    <style>
        .card {
            border-radius: 0.5rem;
        }

        .section-header {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
        }

        .btn-group .btn {
            flex: 1;
        }

        .btn-check:checked+.btn-outline-primary {
            background-color: rgba(13, 110, 253, 0.1);
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .input-group-text {
            background-color: #f8f9fa;
        }

        .marks-container {
            background-color: #f8fafc;
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid #e9ecef;
        }

        .form-control[readonly] {
            background-color: #f8f9fa;
        }

        .rounded-pill {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    </style>
</div>
