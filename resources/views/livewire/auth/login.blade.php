<section class="min-vh-100 d-flex align-items-center bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <!-- Logo Section - Added above the card -->
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/img/ShifaLogo.png') }}" alt="University Logo" class="img-fluid"
                        style="max-height: 130px;">
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- Card Header - Simplified -->
                    <div class="card-header bg-white py-3 text-center border-0">
                        <h3 class="fw-bold text-primary mb-1">{{ __('Welcome to STMU') }}</h3>
                        <p class="text-muted small mb-0">{{ __('Sign in to your account') }}</p>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <form wire:submit="login" action="#" method="POST">
                            <!-- Email Field -->
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

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password"
                                    class="form-label small fw-bold text-muted">{{ __('Password') }}</label>
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input wire:model.live="password" id="password" type="password"
                                        class="form-control form-control-lg rounded-3" placeholder="••••••••">
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input wire:model.live="remember_me" class="form-check-input" type="checkbox"
                                        id="rememberMe">
                                    <label class="form-check-label small text-muted"
                                        for="rememberMe">{{ __('Remember me') }}</label>
                                </div>
                                <div>
                                    <a href="{{ route('forgot-password') }}"
                                        class="small text-primary fw-bold">{{ __('Forgot password?') }}</a>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 py-3 fw-bold">
                                    {{ __('Sign in') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer bg-white text-center pt-0 pb-4 border-0">
                        <p class="small text-muted mb-0">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('sign-up') }}" class="text-primary fw-bold">{{ __('Sign up') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
