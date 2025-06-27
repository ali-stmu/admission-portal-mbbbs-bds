<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0 d-flex align-items-center">
            <i class="fas fa-user-circle me-2"></i>
            Personal Profile Information
        </h4>
    </div>
    <div class="card-body p-4">
        <div class="alert alert-info d-flex align-items-center">
            <i class="fas fa-id-card me-2 fs-4"></i>
            <div>
                <strong>Application No:</strong>
                <span class="badge bg-primary ms-2">{{ $applicationNo }}</span>
            </div>
        </div>

        <form wire:submit.prevent="save">
            <!-- Personal Information Section -->
            <div class="row mb-4 g-4">
                <div class="col-12">
                    <div class="section-header bg-light p-3 rounded">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-user me-2"></i>
                            Personal Information
                        </h5>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Photo Upload -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Picture (Passport Size)</label>
                        <div class="file-upload-wrapper">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                wire:model="photo" accept="image/*">
                            <div class="file-upload-message">
                                <i class="fas fa-cloud-upload-alt me-2"></i>
                                Click to upload or drag and drop
                            </div>
                            @error('photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-1">Max 1MB • JPG/PNG format</small>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                wire:model="name" placeholder="Your full name">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CNIC -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">CNIC</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" class="form-control @error('cnic') is-invalid @enderror"
                                wire:model="cnic" placeholder="XXXXX-XXXXXXX-X">
                        </div>
                        @error('cnic')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CNIC Copy Upload -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload CNIC Copy</label>
                        <div class="file-upload-wrapper">
                            <input type="file" class="form-control @error('cnicCopy') is-invalid @enderror"
                                wire:model="cnicCopy" accept=".pdf,.jpg,.jpeg,.png">
                            <div class="file-upload-message">
                                <i class="fas fa-file-upload me-2"></i>
                                Upload CNIC document
                            </div>
                            @error('cnicCopy')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-1">Max 2MB • PDF/JPG/PNG format</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gender</label>
                        <div class="btn-group-vertical w-100" role="group">
                            <div class="form-check form-check-inline w-100 mb-2">
                                <input class="form-check-input" type="radio" wire:model="gender" id="genderMale"
                                    value="male">
                                <label class="form-check-label w-100 py-2 rounded" for="genderMale">
                                    <i class="fas fa-male me-2"></i> Male
                                </label>
                            </div>
                            <div class="form-check form-check-inline w-100 mb-2">
                                <input class="form-check-input" type="radio" wire:model="gender" id="genderFemale"
                                    value="female">
                                <label class="form-check-label w-100 py-2 rounded" for="genderFemale">
                                    <i class="fas fa-female me-2"></i> Female
                                </label>
                            </div>
                            <div class="form-check form-check-inline w-100">
                                <input class="form-check-input" type="radio" wire:model="gender" id="genderOther"
                                    value="other">
                                <label class="form-check-label w-100 py-2 rounded" for="genderOther">
                                    <i class="fas fa-transgender me-2"></i> Other
                                </label>
                            </div>
                        </div>
                        @error('gender')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Date of Birth</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                wire:model="dob">
                        </div>
                        @error('dob')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mobile Number -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mobile Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                wire:model="mobile" placeholder="+92 XXX XXXXXXX">
                        </div>
                        @error('mobile')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nationality -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nationality</label>
                        <div class="d-flex gap-3">
                            <div class="form-check flex-grow-1">
                                <input class="form-check-input" type="radio" wire:model="nationality"
                                    id="nationalityPakistani" value="pakistani">
                                <label class="form-check-label w-100 btn btn-outline-primary py-2"
                                    for="nationalityPakistani">
                                    <i class="fas fa-flag me-2"></i> Pakistani
                                </label>
                            </div>
                            <div class="form-check flex-grow-1">
                                <input class="form-check-input" type="radio" wire:model="nationality"
                                    id="nationalityForeign" value="foreign">
                                <label class="form-check-label w-100 btn btn-outline-primary py-2"
                                    for="nationalityForeign">
                                    <i class="fas fa-globe me-2"></i> Foreign
                                </label>
                            </div>
                        </div>
                        @error('nationality')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Foreign Applicant Section -->
            <div class="row mb-4 g-4" x-data="{ showForeignFields: false }" x-show="$wire.nationality === 'foreign'">
                <div class="col-12">
                    <div class="section-header bg-light p-3 rounded">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-passport me-2"></i>
                            Foreign Applicant Information
                        </h5>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Passport Number -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Passport Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-passport"></i></span>
                            <input type="text" class="form-control @error('passportNo') is-invalid @enderror"
                                wire:model="passportNo">
                        </div>
                        @error('passportNo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Passport Copy Upload -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Passport Copy</label>
                        <div class="file-upload-wrapper">
                            <input type="file" class="form-control @error('passportCopy') is-invalid @enderror"
                                wire:model="passportCopy" accept=".pdf,.jpg,.jpeg,.png">
                            <div class="file-upload-message">
                                <i class="fas fa-file-upload me-2"></i>
                                Upload passport document
                            </div>
                            @error('passportCopy')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-1">Max 2MB • PDF/JPG/PNG format</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Father's Information Section -->
            <div class="row mb-4 g-4">
                <div class="col-12">
                    <div class="section-header bg-light p-3 rounded">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-user-friends me-2"></i>
                            Father's Information
                        </h5>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Father's Name -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Father's Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('fatherName') is-invalid @enderror"
                                wire:model="fatherName">
                        </div>
                        @error('fatherName')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Father's NIC -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Father's NIC</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" class="form-control @error('fatherNic') is-invalid @enderror"
                                wire:model="fatherNic">
                        </div>
                        @error('fatherNic')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Father's Email -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Father's Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control @error('fatherEmail') is-invalid @enderror"
                                wire:model="fatherEmail">
                        </div>
                        @error('fatherEmail')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Father's Profession -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Father's Profession</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                            <input type="text"
                                class="form-control @error('fatherProfession') is-invalid @enderror"
                                wire:model="fatherProfession">
                        </div>
                        @error('fatherProfession')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Father's Company -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Company/Organization</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control @error('fatherCompany') is-invalid @enderror"
                                wire:model="fatherCompany">
                        </div>
                        @error('fatherCompany')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Father's Mobile -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Father's Mobile Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" class="form-control @error('fatherMobile') is-invalid @enderror"
                                wire:model="fatherMobile">
                        </div>
                        @error('fatherMobile')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Address Sections -->
            <div class="row mb-4 g-4">
                <!-- Mailing Address -->
                <div class="col-12">
                    <div class="section-header bg-light p-3 rounded">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-envelope me-2"></i>
                            Mailing Address
                        </h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">House No</label>
                        <input type="text" class="form-control @error('mailingHouseNo') is-invalid @enderror"
                            wire:model="mailingHouseNo">
                        @error('mailingHouseNo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Street</label>
                        <input type="text" class="form-control @error('mailingStreet') is-invalid @enderror"
                            wire:model="mailingStreet">
                        @error('mailingStreet')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Sector</label>
                        <input type="text" class="form-control @error('mailingSector') is-invalid @enderror"
                            wire:model="mailingSector">
                        @error('mailingSector')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tehsil</label>
                        <input type="text" class="form-control @error('mailingTehsil') is-invalid @enderror"
                            wire:model="mailingTehsil">
                        @error('mailingTehsil')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">City</label>
                        <input type="text" class="form-control @error('mailingCity') is-invalid @enderror"
                            wire:model="mailingCity">
                        @error('mailingCity')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Country</label>
                        <input type="text" class="form-control @error('mailingCountry') is-invalid @enderror"
                            wire:model="mailingCountry" value="Pakistan" readonly>
                        @error('mailingCountry')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Permanent Address -->
            <div class="row mb-4 g-4">
                <div class="col-12">
                    <div class="section-header bg-light p-3 rounded d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-home me-2"></i>
                            Permanent Address
                        </h5>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="sameAsMailing"
                                wire:model="sameAsMailing" style="width: 3em; height: 1.5em;">
                            <label class="form-check-label ms-2 fw-bold" for="sameAsMailing">
                                Same as Mailing Address
                            </label>
                        </div>
                    </div>
                </div>

                @if (!$sameAsMailing)
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">House No</label>
                            <input type="text"
                                class="form-control @error('permanentHouseNo') is-invalid @enderror"
                                wire:model="permanentHouseNo">
                            @error('permanentHouseNo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Street</label>
                            <input type="text" class="form-control @error('permanentStreet') is-invalid @enderror"
                                wire:model="permanentStreet">
                            @error('permanentStreet')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Sector</label>
                            <input type="text" class="form-control @error('permanentSector') is-invalid @enderror"
                                wire:model="permanentSector">
                            @error('permanentSector')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tehsil</label>
                            <input type="text" class="form-control @error('permanentTehsil') is-invalid @enderror"
                                wire:model="permanentTehsil">
                            @error('permanentTehsil')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">City</label>
                            <input type="text" class="form-control @error('permanentCity') is-invalid @enderror"
                                wire:model="permanentCity">
                            @error('permanentCity')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Country</label>
                            <input type="text"
                                class="form-control @error('permanentCountry') is-invalid @enderror"
                                wire:model="permanentCountry" value="Pakistan" readonly>
                            @error('permanentCountry')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
                    <i class="fas fa-save me-2"></i>
                    Save & Continue
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

        .file-upload-wrapper {
            position: relative;
        }

        .file-upload-message {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 0.375rem 0.75rem;
            pointer-events: none;
            color: #6c757d;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }

        .form-control[type="file"] {
            opacity: 0;
            height: 2.5rem;
        }

        .form-check-input[type="radio"] {
            width: 1.2em;
            height: 1.2em;
        }

        .form-check-label {
            cursor: pointer;
        }

        .btn-group-vertical .form-check-label {
            border: 1px solid #dee2e6;
            transition: all 0.2s;
        }

        .form-check-input:checked+.form-check-label {
            background-color: rgba(13, 110, 253, 0.1);
            border-color: #0d6efd;
        }

        .form-switch .form-check-input {
            cursor: pointer;
        }
    </style>
</div>
