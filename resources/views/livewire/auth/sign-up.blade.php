<section class="h-100-vh mb-8">
    <div class="page-header align-items-start section-height-50 pt-5 pb-11 m-3 border-radius-lg"
        style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">{{ __('Welcome!') }}</h1>
                    <p class="text-lead text-white">
                        {{ __('Join STMU and enjoy our services') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0 shadow">
                    <div class="card-header text-center pt-4">
                        <h5>{{ __('Create your account') }}</h5>
                    </div>

                    <div class="card-body">
                        <form wire:submit.prevent="register" x-data="{ nationality: '' }">

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Full Name') }}</label>
                                <div class="@error('name') border border-danger rounded-3 @enderror">
                                    <input wire:model.live="name" id="name" type="text" class="form-control"
                                        placeholder="Your name">
                                </div>
                                @error('name')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <div class="@error('email') border border-danger rounded-3 @enderror">
                                    <input wire:model.live="email" id="email" type="email" class="form-control"
                                        placeholder="your@email.com">
                                </div>
                                @error('email')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nationality -->
                            <div class="mb-3">
                                <label for="nationality" class="form-label">{{ __('Nationality') }}</label>
                                <select wire:model.live="nationality" x-model="nationality" id="nationality"
                                    class="form-select">
                                    <option value="">{{ __('Select Nationality') }}</option>
                                    <option value="local">Local</option>
                                    <option value="foreign">Foreign</option>
                                    <option value="special_foreign">Special Foreign</option>
                                </select>
                                @error('nationality')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- CNIC (Only if Local) -->
                            <div class="mb-3" x-show="nationality === 'local'" x-cloak>
                                <label for="cnic" class="form-label">{{ __('CNIC') }}</label>
                                <input wire:model.live="cnic" id="cnic" type="text" class="form-control"
                                    placeholder="e.g., 35201-1234567-8">
                                @error('cnic')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Passport (Only if Foreign or Special Foreign) -->
                            <div class="mb-3" x-show="nationality === 'foreign' || nationality === 'special_foreign'"
                                x-cloak>
                                <label for="passport" class="form-label">{{ __('Passport Number') }}</label>
                                <input wire:model.live="cnic" id="passport" type="text" class="form-control"
                                    placeholder="Passport No.">
                                @error('passport')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input wire:model.live="password" id="password" type="password"
                                        class="form-control" placeholder="Password">
                                </div>
                                @error('password')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Terms -->
                            <div class="form-check form-check-info text-start mb-4">
                                <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">
                                    {{ __('I agree to the') }} <a href="#"
                                        class="text-dark font-weight-bolder">{{ __('Terms and Conditions') }}</a>
                                </label>
                            </div>

                            <!-- Submit -->
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2 py-2">
                                    {{ __('Sign Up') }}
                                </button>
                            </div>

                            <!-- Already Registered -->
                            <p class="text-sm mt-3 mb-0 text-center">
                                {{ __('Already have an account?') }}
                                <a href="{{ route('login') }}"
                                    class="text-dark font-weight-bolder ms-1">{{ __('Sign In') }}</a>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
