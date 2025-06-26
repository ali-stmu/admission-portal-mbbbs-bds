<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Personal Profile Information</h4>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <strong>Application No:</strong> {{ $applicationNo }}
        </div>

        <form wire:submit.prevent="save">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="border-bottom pb-2">Personal Information</h5>

                    <div class="mb-3">
                        <label class="form-label">Upload Picture (Passport Size)</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                            wire:model="photo">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 1MB, JPG/PNG format</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            wire:model="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CNIC</label>
                        <input type="text" class="form-control @error('cnic') is-invalid @enderror" wire:model="cnic"
                            placeholder="XXXXX-XXXXXXX-X">
                        @error('cnic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload CNIC Copy</label>
                        <input type="file" class="form-control @error('cnicCopy') is-invalid @enderror"
                            wire:model="cnicCopy">
                        @error('cnicCopy')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 2MB, PDF/JPG/PNG format</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model="gender" id="genderMale"
                                    value="male">
                                <label class="form-check-label" for="genderMale">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model="gender" id="genderFemale"
                                    value="female">
                                <label class="form-check-label" for="genderFemale">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model="gender" id="genderOther"
                                    value="other">
                                <label class="form-check-label" for="genderOther">Other</label>
                            </div>
                        </div>
                        @error('gender')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control @error('dob') is-invalid @enderror" wire:model="dob">
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                            wire:model="mobile">
                        @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Passport Number (For Foreign Applicants)</label>
                        <input type="text" class="form-control @error('passportNo') is-invalid @enderror"
                            wire:model="passportNo">
                        @error('passportNo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Passport Copy (For Foreign Applicants)</label>
                        <input type="file" class="form-control @error('passportCopy') is-invalid @enderror"
                            wire:model="passportCopy">
                        @error('passportCopy')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 2MB, PDF/JPG/PNG format</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Domicile</label>
                        <input type="text" class="form-control @error('domicile') is-invalid @enderror"
                            wire:model="domicile">
                        @error('domicile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            wire:model="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nationality</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model="nationality"
                                    id="nationalityPakistani" value="pakistani">
                                <label class="form-check-label" for="nationalityPakistani">Pakistani</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model="nationality"
                                    id="nationalityForeign" value="foreign">
                                <label class="form-check-label" for="nationalityForeign">Foreign</label>
                            </div>
                        </div>
                        @error('nationality')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Province</label>
                        <select class="form-select @error('province') is-invalid @enderror" wire:model="province">
                            <option value="">Select Province</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Sindh">Sindh</option>
                            <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                            <option value="Balochistan">Balochistan</option>
                            <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                            <option value="Azad Jammu and Kashmir">Azad Jammu and Kashmir</option>
                            <option value="Islamabad Capital Territory">Islamabad Capital Territory</option>
                        </select>
                        @error('province')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="border-bottom pb-2">Father's Information</h5>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Father's Name</label>
                        <input type="text" class="form-control @error('fatherName') is-invalid @enderror"
                            wire:model="fatherName">
                        @error('fatherName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Father's NIC</label>
                        <input type="text" class="form-control @error('fatherNic') is-invalid @enderror"
                            wire:model="fatherNic">
                        @error('fatherNic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Father's Email</label>
                        <input type="email" class="form-control @error('fatherEmail') is-invalid @enderror"
                            wire:model="fatherEmail">
                        @error('fatherEmail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Father's Profession</label>
                        <input type="text" class="form-control @error('fatherProfession') is-invalid @enderror"
                            wire:model="fatherProfession">
                        @error('fatherProfession')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Company/Organization</label>
                        <input type="text" class="form-control @error('fatherCompany') is-invalid @enderror"
                            wire:model="fatherCompany">
                        @error('fatherCompany')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Father's Mobile Number</label>
                        <input type="text" class="form-control @error('fatherMobile') is-invalid @enderror"
                            wire:model="fatherMobile">
                        @error('fatherMobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="border-bottom pb-2">Mailing Address</h5>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">House No</label>
                        <input type="text" class="form-control @error('mailingHouseNo') is-invalid @enderror"
                            wire:model="mailingHouseNo">
                        @error('mailingHouseNo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Street</label>
                        <input type="text" class="form-control @error('mailingStreet') is-invalid @enderror"
                            wire:model="mailingStreet">
                        @error('mailingStreet')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Sector</label>
                        <input type="text" class="form-control @error('mailingSector') is-invalid @enderror"
                            wire:model="mailingSector">
                        @error('mailingSector')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Tehsil</label>
                        <input type="text" class="form-control @error('mailingTehsil') is-invalid @enderror"
                            wire:model="mailingTehsil">
                        @error('mailingTehsil')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control @error('mailingCity') is-invalid @enderror"
                            wire:model="mailingCity">
                        @error('mailingCity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control @error('mailingCountry') is-invalid @enderror"
                            wire:model="mailingCountry">
                        @error('mailingCountry')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="border-bottom pb-2">Permanent Address</h5>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="sameAsMailing"
                            wire:model="sameAsMailing">
                        <label class="form-check-label" for="sameAsMailing">
                            Same as Mailing Address
                        </label>
                    </div>
                </div>

                @if (!$sameAsMailing)
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">House No</label>
                            <input type="text"
                                class="form-control @error('permanentHouseNo') is-invalid @enderror"
                                wire:model="permanentHouseNo">
                            @error('permanentHouseNo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Street</label>
                            <input type="text" class="form-control @error('permanentStreet') is-invalid @enderror"
                                wire:model="permanentStreet">
                            @error('permanentStreet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Sector</label>
                            <input type="text" class="form-control @error('permanentSector') is-invalid @enderror"
                                wire:model="permanentSector">
                            @error('permanentSector')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tehsil</label>
                            <input type="text" class="form-control @error('permanentTehsil') is-invalid @enderror"
                                wire:model="permanentTehsil">
                            @error('permanentTehsil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control @error('permanentCity') is-invalid @enderror"
                                wire:model="permanentCity">
                            @error('permanentCity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <input type="text"
                                class="form-control @error('permanentCountry') is-invalid @enderror"
                                wire:model="permanentCountry">
                            @error('permanentCountry')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Save & Continue <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
