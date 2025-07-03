<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-header bg-gradient-primary-to-secondary text-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Personal Profile Information</h4>
            <span class="badge bg-white text-primary fs-6">{{ $applicationNo }}</span>
        </div>
    </div>

    <div class="card-body p-4">
        <form wire:submit.prevent="save" class="needs-validation" novalidate>
            <!-- Personal Information Section -->
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <h5 class="fw-bold text-primary mb-4 d-flex align-items-center">
                        <i class="fas fa-user-circle me-2"></i> Personal Information
                    </h5>
                </div>

                <!-- Photo Upload -->
                <div class="col-md-3">
                    <div class="profile-picture-upload">
                        <label class="form-label fw-semibold">Profile Picture</label>
                        <div class="position-relative">
                            <div class="profile-picture-preview mb-3 rounded-circle overflow-hidden border border-3 border-light shadow-sm"
                                style="width: 150px; height: 150px; background-color: #f8f9fa;">
                                @if ($photo)
                                    @if (is_object($photo))
                                        <img src="{{ $photo->temporaryUrl() }}" class="w-100 h-100 object-fit-cover">
                                    @elseif (is_string($photo))
                                        <img src="{{ asset('storage/' . $photo) }}"
                                            class="w-100 h-100 object-fit-cover">
                                    @else
                                        <div
                                            class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="fas fa-user fa-3x"></i>
                                        </div>
                                    @endif
                                @endif

                            </div>
                            <input type="file" class="form-control visually-hidden" id="photoUpload"
                                wire:model="photo" accept="image/*">
                            <label for="photoUpload"
                                class="btn btn-sm btn-outline-primary position-absolute bottom-0 start-0">
                                <i class="fas fa-camera me-1"></i> Upload
                            </label>
                        </div>
                        @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 1MB • JPG/PNG</small>
                    </div>
                </div>

                <!-- Personal Details -->
                <div class="col-md-9">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    wire:model="name" placeholder="Your full name" required readonly>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CNIC <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" class="form-control @error('cnic') is-invalid @enderror"
                                    wire:model="cnic" placeholder="XXXXX-XXXXXXX-X" required
                                    {{ $studentId ? '' : 'readonly' }}> <!-- Only readonly for new records -->
                            </div>
                            @error('cnic')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date of Birth <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                    wire:model="dob" required>
                            </div>
                            @error('dob')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" wire:model="gender" id="genderMale"
                                    value="male" autocomplete="off">
                                <label class="btn btn-outline-primary" for="genderMale"><i class="fas fa-male me-1"></i>
                                    Male</label>

                                <input type="radio" class="btn-check" wire:model="gender" id="genderFemale"
                                    value="female" autocomplete="off">
                                <label class="btn btn-outline-primary" for="genderFemale"><i
                                        class="fas fa-female me-1"></i> Female</label>

                                <input type="radio" class="btn-check" wire:model="gender" id="genderOther"
                                    value="other" autocomplete="off">
                                <label class="btn btn-outline-primary" for="genderOther">Other</label>
                            </div>
                            @error('gender')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mobile Number <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                    wire:model="mobile" placeholder="03001234567" required>
                            </div>
                            @error('mobile')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    wire:model="email" placeholder="your@email.com" required readonly>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nationality <span
                                    class="text-danger">*</span></label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" wire:model="nationality"
                                    id="nationalityPakistani" value="pakistani" autocomplete="off"
                                    {{ !$showPassportFields ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="nationalityPakistani">Pakistani</label>

                                <input type="radio" class="btn-check" wire:model="nationality"
                                    id="nationalityForeign" value="foreign" autocomplete="off"
                                    {{ $showPassportFields ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="nationalityForeign">Foreign</label>
                            </div>
                            @error('nationality')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Province </label>
                            <select class="form-select @error('province') is-invalid @enderror" wire:model="province"
                                required>
                                <option value="" selected disabled>Select Province</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Sindh">Sindh</option>
                                <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                <option value="Balochistan">Balochistan</option>
                                <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                                <option value="Azad Jammu and Kashmir">Azad Jammu and Kashmir</option>
                                <option value="Islamabad Capital Territory">Islamabad Capital Territory</option>
                            </select>
                            @error('province')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($showPassportFields)
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Passport Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                    <input type="text"
                                        class="form-control @error('passportNo') is-invalid @enderror"
                                        wire:model="passportNo">
                                </div>
                                @error('passportNo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Passport Copy</label>

                                {{-- File input --}}
                                <input type="file" class="form-control @error('passportCopy') is-invalid @enderror"
                                    wire:model="passportCopy">

                                {{-- Error --}}
                                @error('passportCopy')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                {{-- File Preview or Download --}}
                                @if ($passportCopy)
                                    @if (is_object($passportCopy))
                                        <p class="mt-2">

                                        </p>
                                    @elseif (is_string($passportCopy))
                                        <p class="mt-2">
                                            <a href="{{ asset('storage/' . $passportCopy) }}" target="_blank"
                                                class="btn btn-sm btn-outline-warning">
                                                View Existing Passport
                                            </a>
                                        </p>
                                    @endif
                                @endif

                                <small class="text-muted">Max 2MB • PDF/JPG/PNG</small>
                            </div>

                        @endif

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Domicile </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control @error('domicile') is-invalid @enderror"
                                    wire:model="domicile" required>
                            </div>
                            @error('domicile')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CNIC Copy</label>

                            {{-- File input --}}
                            <input type="file" class="form-control @error('cnicCopy') is-invalid @enderror"
                                wire:model="cnicCopy">

                            {{-- Error --}}
                            @error('cnicCopy')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            {{-- File Preview or Download --}}
                            @if ($cnicCopy)
                                @if (is_object($cnicCopy))
                                    <p class="mt-2">

                                    </p>
                                @elseif (is_string($cnicCopy))
                                    <p class="mt-2">
                                        <a href="{{ asset('storage/' . $cnicCopy) }}" target="_blank"
                                            class="btn btn-sm btn-outline-success">
                                            View Existing CNIC
                                        </a>
                                    </p>
                                @endif
                            @endif

                            <small class="text-muted">Max 2MB • PDF/JPG/PNG</small>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Father's Information Section -->
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <h5 class="fw-bold text-primary mb-4 d-flex align-items-center">
                        <i class="fas fa-user-tie me-2"></i> Father's Information
                    </h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Father's Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control @error('fatherName') is-invalid @enderror"
                            wire:model="fatherName" required>
                    </div>
                    @error('fatherName')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Father's NIC </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control @error('fatherNic') is-invalid @enderror"
                            wire:model="fatherNic" required>
                    </div>
                    @error('fatherNic')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Father's/Guardian's Mobile Number <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                        <input type="text" class="form-control @error('fatherMobile') is-invalid @enderror"
                            wire:model="fatherMobile" required>
                    </div>
                    @error('fatherMobile')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Father's/Guardian's Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control @error('fatherEmail') is-invalid @enderror"
                            wire:model="fatherEmail">
                    </div>
                    @error('fatherEmail')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Father's/Guardian's Profession</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                        <input type="text" class="form-control @error('fatherProfession') is-invalid @enderror"
                            wire:model="fatherProfession">
                    </div>
                    @error('fatherProfession')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Father's/Guardian's Company/Organization</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                        <input type="text" class="form-control @error('fatherCompany') is-invalid @enderror"
                            wire:model="fatherCompany">
                    </div>
                    @error('fatherCompany')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Mailing Address Section -->
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <h5 class="fw-bold text-primary mb-4 d-flex align-items-center">
                        <i class="fas fa-envelope me-2"></i> Mailing Address
                    </h5>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">House No </span></label>
                    <input type="text" class="form-control @error('mailingHouseNo') is-invalid @enderror"
                        wire:model="mailingHouseNo" required>
                    @error('mailingHouseNo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Street <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('mailingStreet') is-invalid @enderror"
                        wire:model="mailingStreet" required>
                    @error('mailingStreet')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Sector/Area </label>
                    <input type="text" class="form-control @error('mailingSector') is-invalid @enderror"
                        wire:model="mailingSector" required>
                    @error('mailingSector')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tehsil</label>
                    <input type="text" class="form-control @error('mailingTehsil') is-invalid @enderror"
                        wire:model="mailingTehsil" required>
                    @error('mailingTehsil')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('mailingCity') is-invalid @enderror"
                        wire:model="mailingCity" required>
                    @error('mailingCity')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Country <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('mailingCountry') is-invalid @enderror"
                        wire:model="mailingCountry" required>
                    @error('mailingCountry')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Permanent Address Section -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-primary mb-0 d-flex align-items-center">
                            <i class="fas fa-home me-2"></i> Permanent Address
                        </h5>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="sameAsMailing"
                                wire:model="sameAsMailing" style="width: 3em; height: 1.5em;">
                            <label class="form-check-label fw-semibold" for="sameAsMailing">Same as Mailing
                                Address</label>
                        </div>
                    </div>
                    <hr class="mt-2">
                </div>

                @if (!$sameAsMailing)
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">House No</label>
                        <input type="text" class="form-control @error('permanentHouseNo') is-invalid @enderror"
                            wire:model="permanentHouseNo" required>
                        @error('permanentHouseNo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Street</label>
                        <input type="text" class="form-control @error('permanentStreet') is-invalid @enderror"
                            wire:model="permanentStreet" required>
                        @error('permanentStreet')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Sector/Area</label>
                        <input type="text" class="form-control @error('permanentSector') is-invalid @enderror"
                            wire:model="permanentSector" required>
                        @error('permanentSector')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tehsil</label>
                        <input type="text" class="form-control @error('permanentTehsil') is-invalid @enderror"
                            wire:model="permanentTehsil" required>
                        @error('permanentTehsil')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">City</label>
                        <input type="text" class="form-control @error('permanentCity') is-invalid @enderror"
                            wire:model="permanentCity" required>
                        @error('permanentCity')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Country</label>
                        <input type="text" class="form-control @error('permanentCountry') is-invalid @enderror"
                            wire:model="permanentCountry" required>
                        @error('permanentCountry')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
            </div>

            <!-- Form Actions -->
            <div class="d-flex justify-content-between mt-5">
                <button type="button" class="btn btn-outline-secondary" wire:click="$dispatch('previousStep')">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </button>
                <button type="submit" class="btn btn-primary px-4">
                    Save & Continue <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </form>
    </div>
    <style>
        .profile-picture-upload {
            position: relative;
        }

        .profile-picture-preview {
            transition: all 0.3s ease;
        }

        .profile-picture-preview:hover {
            transform: scale(1.05);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .bg-gradient-primary-to-secondary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .form-label {
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
        }

        .btn-check:checked+.btn-outline-primary {
            background-color: #4e73df;
            color: white;
            border-color: #4e73df;
        }

        .btn-outline-primary:hover {
            color: white;
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .invalid-feedback {
            font-size: 0.75rem;
        }
    </style>

</div>
