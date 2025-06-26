<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Academic Records</h4>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="border-bottom pb-2">Matriculation / O-levels or equivalent</h5>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">School</label>
                        <input type="text" class="form-control @error('matricRecords.school') is-invalid @enderror"
                            wire:model="matricRecords.school">
                        @error('matricRecords.school')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Board</label>
                        <input type="text" class="form-control @error('matricRecords.board') is-invalid @enderror"
                            wire:model="matricRecords.board">
                        @error('matricRecords.board')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <input type="number" class="form-control @error('matricRecords.year') is-invalid @enderror"
                            wire:model="matricRecords.year">
                        @error('matricRecords.year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Result Status</label>
                        <select class="form-select @error('matricRecords.result_status') is-invalid @enderror"
                            wire:model="matricRecords.result_status">
                            <option value="declared">Declared</option>
                            <option value="awaited">Awaited</option>
                        </select>
                        @error('matricRecords.result_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Maximum Marks</label>
                        <input type="number"
                            class="form-control @error('matricRecords.maximum_marks') is-invalid @enderror"
                            wire:model="matricRecords.maximum_marks" wire:change="calculatePercentage('matric')">
                        @error('matricRecords.maximum_marks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Obtained Marks</label>
                        <input type="number"
                            class="form-control @error('matricRecords.obtained_marks') is-invalid @enderror"
                            wire:model="matricRecords.obtained_marks" wire:change="calculatePercentage('matric')">
                        @error('matricRecords.obtained_marks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Percentage</label>
                        <input type="text"
                            class="form-control @error('matricRecords.percentage') is-invalid @enderror"
                            wire:model="matricRecords.percentage" readonly>
                        @error('matricRecords.percentage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="border-bottom pb-2">Intermediate / A-levels/ High School or equivalent</h5>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">College</label>
                        <input type="text"
                            class="form-control @error('intermediateRecords.school_college') is-invalid @enderror"
                            wire:model="intermediateRecords.school_college">
                        @error('intermediateRecords.school_college')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Board</label>
                        <input type="text"
                            class="form-control @error('intermediateRecords.board') is-invalid @enderror"
                            wire:model="intermediateRecords.board">
                        @error('intermediateRecords.board')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <input type="number"
                            class="form-control @error('intermediateRecords.year') is-invalid @enderror"
                            wire:model="intermediateRecords.year">
                        @error('intermediateRecords.year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Result Status</label>
                        <select class="form-select @error('intermediateRecords.result_status') is-invalid @enderror"
                            wire:model="intermediateRecords.result_status">
                            <option value="declared">Declared</option>
                            <option value="awaited">Awaited</option>
                        </select>
                        @error('intermediateRecords.result_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Maximum Marks</label>
                        <input type="number"
                            class="form-control @error('intermediateRecords.maximum_marks') is-invalid @enderror"
                            wire:model="intermediateRecords.maximum_marks"
                            wire:change="calculatePercentage('intermediate')">
                        @error('intermediateRecords.maximum_marks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Obtained Marks</label>
                        <input type="number"
                            class="form-control @error('intermediateRecords.obtained_marks') is-invalid @enderror"
                            wire:model="intermediateRecords.obtained_marks"
                            wire:change="calculatePercentage('intermediate')">
                        @error('intermediateRecords.obtained_marks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Percentage</label>
                        <input type="text"
                            class="form-control @error('intermediateRecords.percentage') is-invalid @enderror"
                            wire:model="intermediateRecords.percentage" readonly>
                        @error('intermediateRecords.percentage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" wire:click="$dispatch('previousStep')">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </button>
                <button type="submit" class="btn btn-primary">
                    Save & Continue <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
