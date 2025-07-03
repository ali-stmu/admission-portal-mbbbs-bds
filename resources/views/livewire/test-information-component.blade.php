<div class="card border-0 shadow-lg" x-data="{ testType: @entangle('testType'), isInternational: @entangle('isInternational') }">
    <div class="card-header bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0 d-flex align-items-center">
            <i class="fas fa-clipboard-check me-2"></i>
            Test Information
        </h4>
    </div>

    <div class="card-body p-4">
        <form wire:submit.prevent="save">
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- Test Type -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-block mb-3">
                            <i class="fas fa-tasks me-2 text-primary"></i>
                            Type of Test
                        </label>

                        <div class="btn-group-vertical w-100" role="group">
                            <template x-if="!isInternational">
                                <h6 class="text-success fw-bold mb-2">Tests Available for Local Students</h6>
                            </template>

                            <input type="radio" class="btn-check" name="testType" id="testTypeStmu"
                                wire:model="testType" value="stmu">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeStmu">
                                <i class="fas fa-university me-2"></i> <strong>STMU Entrance Test</strong>
                            </label>

                            <input type="radio" class="btn-check" name="testType" id="testTypeMdcat"
                                wire:model="testType" value="mdcat">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeMdcat">
                                <i class="fas fa-flask me-2"></i> <strong>MDCAT</strong>
                            </label>

                            <template x-if="!isInternational">
                                <h6 class="text-muted fw-bold mt-4 mb-2">Tests for Foreign Nationals Only</h6>
                            </template>

                            <input type="radio" class="btn-check" name="testType" id="testTypeSat"
                                wire:model="testType" value="sat-ii" :disabled="!isInternational">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeSat"
                                :class="{ 'disabled': !isInternational }">
                                <i class="fas fa-globe-americas me-2"></i> <strong>SAT-II</strong>
                            </label>

                            <input type="radio" class="btn-check" name="testType" id="testTypeForeign"
                                wire:model="testType" value="foreign-mcat" :disabled="!isInternational">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeForeign"
                                :class="{ 'disabled': !isInternational }">
                                <i class="fas fa-passport me-2"></i> <strong>Foreign MCAT</strong>
                            </label>

                            <input type="radio" class="btn-check" name="testType" id="testTypeUcat"
                                wire:model="testType" value="ucat" :disabled="!isInternational">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeUcat"
                                :class="{ 'disabled': !isInternational }">
                                <i class="fas fa-stethoscope me-2"></i> <strong>UCAT</strong>
                            </label>

                            <input type="radio" class="btn-check" name="testType" id="testTypeOther"
                                wire:model="testType" value="other" :disabled="!isInternational">
                            <label class="btn btn-outline-primary text-start py-3" for="testTypeOther"
                                :class="{ 'disabled': !isInternational }">
                                <i class="fas fa-question-circle me-2"></i> <strong>Other equivalent
                                    examination</strong>
                            </label>
                        </div>
                        @error('testType')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- STMU Center - Only shown when STMU is selected -->
                    <div class="mb-4 animate__animated animate__fadeIn" x-show="testType === 'stmu'">
                        <label class="form-label fw-bold"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Test
                            Center</label>
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
                            Note: In case any center fails to meet the minimum requirement of 50 participants,
                            the test will be conducted at the nearest available center.
                        </div>
                    </div>

                    <!-- Other Test Name - Only shown when 'other' is selected -->
                    <div class="mb-4 animate__animated animate__fadeIn" x-show="testType === 'other'">
                        <label class="form-label fw-bold"><i class="fas fa-pen-alt me-2 text-primary"></i> Test
                            Name</label>
                        <input type="text" class="form-control @error('testName') is-invalid @enderror py-3"
                            wire:model="testName" placeholder="Enter test name">
                        @error('testName')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Test Details Section - Shown for all except STMU -->
                    <div x-show="testType && testType !== 'stmu'"
                        class="test-details-container bg-light p-4 rounded h-100">
                        <h5 class="mb-4 text-primary">
                            <i class="fas fa-file-signature me-2"></i> Test Results
                        </h5>

                        <!-- Test Year -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Test Year</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i
                                        class="fas fa-calendar text-primary"></i></span>
                                <input type="number" wire:model="testYear"
                                    class="form-control @error('testYear') is-invalid @enderror py-3"
                                    placeholder="Enter test year (e.g., 2024)" min="2000"
                                    max="{{ date('Y') }}">
                            </div>
                            @error('testYear')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Result Status -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Result Status</label>
                            <select wire:model="resultStatus"
                                class="form-select @error('resultStatus') is-invalid @enderror py-3">
                                <option value="">Select Status</option>
                                <option value="declared">Declared</option>
                                <option value="awaited">Awaited</option>
                            </select>
                            @error('resultStatus')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Test Score -->
                        <div class="mb-4" x-show="$wire.resultStatus === 'declared'" x-transition>
                            <label class="form-label fw-bold">Test Score</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i
                                        class="fas fa-percentage text-primary"></i></span>
                                <input type="number" step="0.01"
                                    class="form-control @error('testScore') is-invalid @enderror py-3"
                                    wire:model="testScore" placeholder="Enter your score">
                            </div>
                            @error('testScore')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Test Document -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Upload Test Result Document</label>
                            <input type="file" class="form-control @error('testDocument') is-invalid @enderror"
                                wire:model="testDocument" accept=".pdf,.jpg,.jpeg,.png">
                            <div class="file-upload-message p-3 text-center border rounded mt-2">
                                <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                <div class="fw-bold">Click to upload or drag and drop</div>
                                <small class="text-muted">PDF, JPG or PNG (Max 2MB)</small>
                            </div>
                            @error('testDocument')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- STMU Info Box - Only shown when STMU is selected -->
                    <div x-show="testType === 'stmu'" class="test-info-card bg-light p-4 rounded h-100">
                        <div>
                            <i class="fas fa-calendar-alt fa-3x text-primary mb-3"></i>
                            <h5 class="text-primary">STMU Entrance Test</h5>
                            <p class="text-muted">Test center and date will be communicated after registration</p>

                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Important: Please ensure you've selected your preferred test center from the options.
                            </div>
                        </div>
                    </div>
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
</div>
