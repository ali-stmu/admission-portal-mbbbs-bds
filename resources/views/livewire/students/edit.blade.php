<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Edit Student Record</h2>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <!-- Personal Information Card -->
        <div class="card mb-4 border-0 shadow">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Personal Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" wire:model.defer="student.name" class="form-control">
                        </div>
                        @error('student.name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">CNIC</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" wire:model.defer="student.cnic" class="form-control"
                                placeholder="XXXXX-XXXXXXX-X">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Mobile</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            <input type="text" wire:model.defer="student.mobile" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" wire:model.defer="student.email" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Father's Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                            <input type="text" wire:model.defer="student.father_name" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Photo</label>
                        <input type="file" wire:model="photo" class="form-control">
                        @if ($student->photo_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $student->photo_path) }}" width="100"
                                    class="img-thumbnail rounded">
                                <a href="{{ asset('storage/' . $student->photo_path) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary ms-2">
                                    <i class="fas fa-expand me-1"></i>View
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">CNIC Copy</label>
                        <input type="file" wire:model="cnic_copy" class="form-control">
                        @if ($student->cnic_copy_path)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $student->cnic_copy_path) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file-pdf me-1"></i>View CNIC Copy
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Passport Copy</label>
                        <input type="file" wire:model="passport_copy" class="form-control">
                        @if ($student->passport_copy_path)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $student->passport_copy_path) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file-pdf me-1"></i>View Passport Copy
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Records Card -->
        <div class="card mb-4 border-0 shadow">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Academic Records</h5>
                </div>
            </div>
            <div class="card-body">
                @foreach ($academicRecords as $index => $record)
                    <div class="border p-3 mb-3 rounded bg-light">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Level</label>
                                <input type="text" wire:model.defer="academicRecords.{{ $index }}.level"
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">School/College</label>
                                <input type="text"
                                    wire:model.defer="academicRecords.{{ $index }}.school_college"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Board</label>
                                <input type="text" wire:model.defer="academicRecords.{{ $index }}.board"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Year</label>
                                <input type="number" wire:model.defer="academicRecords.{{ $index }}.year"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Result Status</label>
                                <select wire:model.defer="academicRecords.{{ $index }}.result_status"
                                    class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="Declared">Declared</option>
                                    <option value="Awaited">Awaited</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Maximum Marks</label>
                                <input type="number" wire:model="academicRecords.{{ $index }}.maximum_marks"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Obtained Marks</label>
                                <input type="number" wire:model="academicRecords.{{ $index }}.obtained_marks"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Percentage</label>
                                <div class="input-group">
                                    <input type="number"
                                        wire:model.defer="academicRecords.{{ $index }}.percentage"
                                        class="form-control" readonly>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Attachment (Marksheet, Certificate, etc.)</label>
                                <input type="file" wire:model="academicRecords.{{ $index }}.attachment"
                                    class="form-control">

                                @if (isset($record['attachment']) && $record['attachment'])
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $record['attachment']) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-file-alt me-1"></i>View Uploaded Attachment
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Test Information Card -->
        <div class="card mb-4 border-0 shadow">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Test Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Test Type</label>
                        <input type="text" wire:model.defer="testInformation.test_type" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Test Center</label>
                        <input type="text" wire:model.defer="testInformation.test_center" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Test Name</label>
                        <input type="text" wire:model.defer="testInformation.test_name" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Test Score</label>
                        <input type="number" wire:model.defer="testInformation.test_score" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Test Document</label>
                        <input type="file" wire:model="test_document" class="form-control">
                        @if ($testInformation->test_document_path)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $testInformation->test_document_path) }}"
                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file-pdf me-1"></i>View Test Document
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="d-flex justify-content-end gap-3">
            {{-- <button type="reset" class="btn btn-outline-secondary px-4">
                <i class="fas fa-undo me-2"></i>Reset
            </button> --}}
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save me-2"></i>Update Student
            </button>
        </div>
    </form>
</div>
