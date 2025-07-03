<section class="min-vh-100 d-flex flex-column justify-content-center py-5">
    <div class="container">
        <!-- Welcome Header -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6 text-center">
                <h1 class="display-5 fw-bold text-gradient-primary mb-3">{{ __('Welcome!') }}</h1>
                <p class="lead text-muted">
                    {{ __('Join STMU and enjoy our services') }}
                </p>
            </div>
        </div>

        <!-- Registration Card -->
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/img/ShifaLogo.png') }}" alt="University Logo" class="img-fluid"
                        style="max-height: 130px;">
                </div>
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-4 text-center border-0">
                        <h5 class="mb-0 fw-bold text-primary">{{ __('Create your account') }}</h5>
                    </div>


                    <div class="card-body p-4">
                        <form wire:submit.prevent="register" x-data="{ nationality: '' }">
                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="name"
                                    class="form-label small fw-bold text-muted">{{ __('Full Name') }}</label>
                                <div class="@error('name') border border-danger rounded-3 @enderror">
                                    <input wire:model.live="name" id="name" type="text"
                                        class="form-control form-control-lg rounded-3" placeholder="Your name">
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email"
                                    class="form-label small fw-bold text-muted">{{ __('Email') }}</label>
                                <div class="@error('email') border border-danger rounded-3 @enderror">
                                    <input wire:model.live="email" id="email" type="email"
                                        class="form-control form-control-lg rounded-3" placeholder="your@email.com">
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nationality -->
                            <div class="mb-3">
                                <label for="nationality"
                                    class="form-label small fw-bold text-muted">{{ __('Category') }}</label>
                                <select wire:model.live="nationality" x-model="nationality" id="nationality"
                                    class="form-select form-select-lg rounded-3">
                                    <option value="">{{ __('Select Category') }}</option>
                                    <option value="local">Local</option>
                                    <option value="foreign">Foreign</option>
                                </select>
                                @error('nationality')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- CNIC (Only if Local) -->
                            <div class="mb-3" x-show="nationality === 'local'" x-cloak>
                                <label for="cnic"
                                    class="form-label small fw-bold text-muted">{{ __('CNIC') }}</label>
                                <input wire:model.live="cnic" id="cnic" type="text"
                                    class="form-control form-control-lg rounded-3" placeholder="e.g., 35201-1234567-8">
                                @error('cnic')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Passport (Only if Foreign) -->
                            <div class="mb-3" x-show="nationality === 'foreign'" x-cloak>
                                <label for="passport"
                                    class="form-label small fw-bold text-muted">{{ __('Passport Number') }}</label>
                                <input wire:model.live="cnic" id="passport" type="text"
                                    class="form-control form-control-lg rounded-3" placeholder="Passport No.">
                                @error('passport')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password"
                                    class="form-label small fw-bold text-muted">{{ __('Password') }}</label>
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input wire:model.live="password" id="password" type="password"
                                        class="form-control form-control-lg rounded-3" placeholder="Password">
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Terms -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                <label class="form-check-label small text-muted" for="termsCheck">
                                    {{ __('I agree to the') }} <a href="#"
                                        class="text-primary fw-bold">{{ __('Terms and Conditions') }}</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 py-3 fw-bold">
                                    {{ __('Sign Up') }}
                                </button>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center mt-3">
                                <p class="small text-muted mb-0">
                                    {{ __('Already have an account?') }}
                                    <a href="{{ route('login') }}"
                                        class="text-primary fw-bold">{{ __('Sign In') }}</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
