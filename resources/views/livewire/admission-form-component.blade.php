<div>
    <div class="container py-4">
        <div class="text-center mb-4">
            <h2>STMU Admission Portal</h2>
            <p class="lead">Complete your application in simple steps</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="progress mb-4" style="height: 30px;">
                    @foreach ([1, 2, 3, 4, 5, 6] as $step)
                        <div class="progress-bar {{ $currentStep >= $step ? 'bg-primary' : 'bg-light text-dark' }}"
                            style="width: 16.66%; line-height: 30px;">
                            Step {{ $step }}
                        </div>
                    @endforeach
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
</div>
