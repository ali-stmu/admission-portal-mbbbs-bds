<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0 d-flex align-items-center">
            <i class="fas fa-clipboard-check me-2"></i>
            Test Information
        </h4>
    </div>
    <div class="card-body p-4">
        <form wire:submit.prevent="save">
            <div class="row g-4">
                <div class="col-md-6">
                    <!-- Test Type -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-block mb-3">
                            <i class="fas fa-tasks me-2 text-primary"></i>
                            Type of Test
                        </label>
                        <div class="btn-group-vertical w-100" role="group">
                            <input type="radio" class="btn-check" name="testType" id="testTypeStmu"
                                wire:model="testType" value="stmu">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeStmu">
                                <i class="fas fa-university me-2"></i>
                                <strong>STMU Entrance Test</strong>
                            </label>

                            <input type="radio" class="btn-check" name="testType" id="testTypeMdcat"
                                wire:model="testType" value="mdcat">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeMdcat">
                                <i class="fas fa-flask me-2"></i>
                                <strong>MDCAT</strong>
                            </label>

                            <input type="radio" class="btn-check" name="testType" id="testTypeSat"
                                wire:model="testType" value="sat-ii">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeSat">
                                <i class="fas fa-globe-americas me-2"></i>
                                <strong>SAT-II</strong>
                            </label>

                            <input type="radio" class="btn-check" name="testType" id="testTypeForeign"
                                wire:model="testType" value="foreign-mcat">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeForeign">
                                <i class="fas fa-passport me-2"></i>
                                <strong>Foreign MCAT</strong>
                            </label>

                            <input type="radio" class="btn-check" name="testType" id="testTypeUcat"
                                wire:model="testType" value="ucat">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeUcat">
                                <i class="fas fa-stethoscope me-2"></i>
                                <strong>UCAT</strong>
                            </label>

                            <input type="radio" class="btn-check" name="testType" id="testTypeOther"
                                wire:model="testType" value="other">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeOther">
                                <i class="fas fa-question-circle me-2"></i>
                                <strong>Other equivalent examination</strong>
                            </label>
                        </div>
                        @error('testType')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Conditional Fields -->
                    @if ($testType === 'stmu')
                        <div class="mb-4 animate__animated animate__fadeIn">
                            <label class="form-label fw-bold">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                Test Center
                            </label>
                            <select class="form-select @error('testCenter') is-invalid @enderror py-3"
                                wire:model="testCenter">
                                <option value="">Select Test Center</option>
                                @foreach ($testCenters as $center)
                                    <option value="{{ $center }}">{{ $center }}</option>
                                @endforeach
                            </select>
                            @error('testCenter')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Note: In case any center fails to meet the minimum requirement of 50 participants, the
                                test will be conducted at the nearest available center
                            </div>
                        </div>
                    @endif

                    @if ($testType === 'other')
                        <div class="mb-4 animate__animated animate__fadeIn">
                            <label class="form-label fw-bold">
                                <i class="fas fa-pen-alt me-2 text-primary"></i>
                                Test Name
                            </label>
                            <input type="text" class="form-control @error('testName') is-invalid @enderror py-3"
                                wire:model="testName" placeholder="Enter test name">
                            @error('testName')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    @if ($testType !== 'stmu')
                        <div class="test-details-container bg-light p-4 rounded">
                            <h5 class="mb-4 text-primary">
                                <i class="fas fa-file-signature me-2"></i>
                                Test Results
                            </h5>

                            <!-- Test Score -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Test Score</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-percentage text-primary"></i>
                                    </span>
                                    <input type="number" step="0.01"
                                        class="form-control @error('testScore') is-invalid @enderror py-3"
                                        wire:model="testScore" placeholder="Enter your score">
                                </div>
                                @error('testScore')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Test Document Upload -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Upload Test Result Document</label>
                                <div class="file-upload-wrapper">
                                    <input type="file"
                                        class="form-control @error('testDocument') is-invalid @enderror"
                                        wire:model="testDocument" accept=".pdf,.jpg,.jpeg,.png">
                                    <div class="file-upload-message p-3 text-center border rounded">
                                        <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                        <div class="fw-bold">Click to upload or drag and drop</div>
                                        <small class="text-muted">PDF, JPG or PNG (Max 2MB)</small>
                                    </div>
                                </div>
                                @error('testDocument')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @else
                        <div
                            class="test-info-card bg-light p-4 rounded h-100 d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <i class="fas fa-calendar-alt fa-3x text-primary mb-3"></i>
                                <h5 class="text-primary">STMU Entrance Test</h5>
                                <p class="text-muted">Test center and date will be communicated after registration</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="d-flex justify-content-between mt-5">
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

        .btn-group-vertical .btn {
            border-radius: 0.5rem !important;
            margin-bottom: 0.5rem;
            text-align: left;
            transition: all 0.3s ease;
        }

        .btn-check:checked+.btn-outline-primary {
            background-color: rgba(13, 110, 253, 0.1);
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .btn-outline-primary:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }

        .test-details-container {
            border-left: 4px solid #0d6efd;
            background-color: #f8fafc;
        }

        .test-info-card {
            background-color: #f8f9fa;
            border: 1px dashed #dee2e6;
        }

        .file-upload-wrapper {
            position: relative;
        }

        .file-upload-message {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            background-color: white;
        }

        .form-control[type="file"] {
            opacity: 0;
            height: 100%;
            width: 100%;
        }

        .rounded-pill {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .animate__animated {
            animation-duration: 0.3s;
        }
    </style>
</div>
