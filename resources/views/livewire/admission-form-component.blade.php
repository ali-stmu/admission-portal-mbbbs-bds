<div>
    <div class="container py-4">
        <div class="text-center mb-4">
            <h2>STMU Admission Portal</h2>
            <p class="lead">Complete your application in simple steps</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="progress-container mb-4">
                    <div class="progress-steps d-flex justify-content-between position-relative">
                        @foreach ([1, 2, 3, 4, 5, 6] as $step)
                            <div class="step position-relative d-flex flex-column align-items-center">
                                <div
                                    class="step-circle rounded-circle d-flex align-items-center justify-content-center 
                                    {{ $currentStep >= $step ? 'active-step' : 'inactive-step' }}">
                                    @if ($currentStep > $step)
                                        <i class="fas fa-check"></i>
                                    @else
                                        {{ $step }}
                                    @endif
                                </div>
                                <div
                                    class="step-label mt-2 {{ $currentStep >= $step ? 'text-primary fw-bold' : 'text-muted' }}">
                                    @if ($step == 1)
                                        Term
                                    @endif
                                    @if ($step == 2)
                                        Profile
                                    @endif
                                    @if ($step == 3)
                                        Academic
                                    @endif
                                    @if ($step == 4)
                                        Tests
                                    @endif
                                    @if ($step == 5)
                                        Payment
                                    @endif
                                    @if ($step == 6)
                                        Complete
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="progress-bar-background position-absolute"></div>
                        <div class="progress-bar-fill position-absolute" style="width: {{ ($currentStep - 1) * 20 }}%">
                        </div>
                    </div>
                </div>

                @if ($currentStep === 1)
                    <livewire:term-selection-component />
                @elseif($currentStep === 2)
                    <livewire:personal-profile-component :termId="$termId" />
                @elseif($currentStep === 3)
                    <livewire:academic-record-component :studentId="$studentId" />
                @elseif($currentStep === 4)
                    <livewire:test-information-component :studentId="$studentId" />
                @elseif($currentStep === 5)
                    <livewire:payment-information-component :studentId="$studentId" />
                @elseif($currentStep === 6)
                    <livewire:application-complete-component :studentId="$studentId" />
                @endif
            </div>
        </div>
    </div>
    <style>
        .progress-container {
            padding: 0 40px;
        }

        .progress-steps {
            margin-bottom: 30px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            font-size: 18px;
            z-index: 2;
            border: 3px solid;
        }

        .active-step {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd !important;
        }

        .inactive-step {
            background-color: white;
            color: #adb5bd;
            border-color: #adb5bd;
        }

        .progress-bar-background {
            height: 6px;
            background-color: #e9ecef;
            top: 20px;
            left: 50px;
            right: 50px;
            z-index: 1;
        }

        .progress-bar-fill {
            height: 6px;
            background-color: #0d6efd;
            top: 20px;
            left: 50px;
            z-index: 1;
            transition: width 0.3s ease;
        }

        .step-label {
            font-size: 14px;
            text-align: center;
        }
    </style>
</div>
