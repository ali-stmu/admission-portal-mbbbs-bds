<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Test Information</h4>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Type of Test</label>
                        <select class="form-select @error('testType') is-invalid @enderror" wire:model="testType">
                            <option value="stmu">STMU Entrance Test</option>
                            <option value="mdcat">MDCAT</option>
                            <option value="sat-ii">SAT-II</option>
                            <option value="foreign-mcat">Foreign MCAT examination</option>
                            <option value="ucat">UCAT</option>
                            <option value="other">Other equivalent examination</option>
                        </select>
                        @error('testType')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($testType === 'stmu')
                        <div class="mb-3">
                            <label class="form-label">Test Center</label>
                            <select class="form-select @error('testCenter') is-invalid @enderror"
                                wire:model="testCenter">
                                <option value="">Select Test Center</option>
                                @foreach ($testCenters as $center)
                                    <option value="{{ $center }}">{{ $center }}</option>
                                @endforeach
                            </select>
                            @error('testCenter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Note: In case any center fails to meet the minimum requirement of 50 participants, the
                                test will be conducted at the nearest available center
                            </small>
                        </div>
                    @endif

                    @if ($testType === 'other')
                        <div class="mb-3">
                            <label class="form-label">Test Name</label>
                            <input type="text" class="form-control @error('testName') is-invalid @enderror"
                                wire:model="testName">
                            @error('testName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    @if ($testType !== 'stmu')
                        <div class="mb-3">
                            <label class="form-label">Test Score</label>
                            <input type="number" step="0.01"
                                class="form-control @error('testScore') is-invalid @enderror" wire:model="testScore">
                            @error('testScore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Test Result Document</label>
                            <input type="file" class="form-control @error('testDocument') is-invalid @enderror"
                                wire:model="testDocument">
                            @error('testDocument')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Max 2MB, PDF/JPG/PNG format</small>
                        </div>
                    @endif
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
