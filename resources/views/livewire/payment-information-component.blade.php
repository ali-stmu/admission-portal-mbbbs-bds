<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0 d-flex align-items-center">
            <i class="fas fa-credit-card me-2"></i>
            Payment Information
        </h4>
    </div>
    <div class="card-body p-4">
        <div class="alert alert-info d-flex align-items-start">
            <i class="fas fa-info-circle fa-2x me-3 mt-1"></i>
            <div>
                <h5 class="alert-heading mb-3">Fee Structure</h5>
                <ul class="mb-0 list-unstyled">
                    <li class="mb-2 d-flex">
                        <span class="badge bg-primary rounded-pill me-3"
                            style="width: 24px; height: 24px; line-height: 24px;">1</span>
                        <span>Rs. 6,000 for applying to a single program (MBBS or BDS)</span>
                    </li>
                    <li class="mb-2 d-flex">
                        <span class="badge bg-primary rounded-pill me-3"
                            style="width: 24px; height: 24px; line-height: 24px;">2</span>
                        <span>Rs. 8,000 for applying to both programs (MBBS and BDS)</span>
                    </li>
                    <li class="d-flex">
                        <span class="badge bg-primary rounded-pill me-3"
                            style="width: 24px; height: 24px; line-height: 24px;">3</span>
                        <span>One-time application fee of USD 100 for international students</span>
                    </li>
                </ul>
            </div>
        </div>

        <form wire:submit.prevent="save">
            <div class="row g-4">
                <div class="col-md-6">
                    <!-- Program Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-block mb-3">
                            <i class="fas fa-graduation-cap me-2 text-primary"></i>
                            Select Program
                        </label>
                        <div class="btn-group-vertical w-100" role="group">
                            <input type="radio" class="btn-check" name="program" id="programMbbs" wire:model="program"
                                value="mbbs">
                            <label class="btn btn-outline-primary text-start py-3" for="programMbbs">
                                <i class="fas fa-user-md me-2"></i>
                                <strong>MBBS Only</strong>
                                <span class="badge bg-primary float-end">
                                    {{ $isInternational ? '$100' : 'Rs. 6,000' }}
                                </span>
                            </label>

                            <input type="radio" class="btn-check" name="program" id="programBds" wire:model="program"
                                value="bds">
                            <label class="btn btn-outline-primary text-start py-3" for="programBds">
                                <i class="fas fa-tooth me-2"></i>
                                <strong>BDS Only</strong>
                                <span class="badge bg-primary float-end">
                                    {{ $isInternational ? '$100' : 'Rs. 6,000' }}
                                </span>
                            </label>

                            <input type="radio" class="btn-check" name="program" id="programBoth" wire:model="program"
                                value="both">
                            <label class="btn btn-outline-primary text-start py-3" for="programBoth">
                                <i class="fas fa-clipboard-list me-2"></i>
                                <strong>Both MBBS & BDS</strong>
                                <span class="badge bg-primary float-end">
                                    {{ $isInternational ? '$100' : 'Rs. 8,000' }}
                                </span>
                            </label>
                        </div>
                        @error('program')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Amount Display -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fas fa-money-bill-wave me-2 text-primary"></i>
                            Amount Payable
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i
                                    class="{{ $isInternational ? 'fas fa-dollar-sign' : 'fas fa-rupee-sign' }} text-primary"></i>
                            </span>
                            <input type="text"
                                class="form-control @error('amount') is-invalid @enderror py-3 fw-bold"
                                wire:model="amount" readonly style="background-color: #f8f9fa; min-width: 120px;">
                            <span class="input-group-text bg-white" style="min-width: 60px;">
                                {{ $isInternational ? 'USD' : 'PKR' }}
                            </span>
                        </div>
                        @if ($isInternational)
                            <div class="text-muted mt-2">
                                Approx. PKR {{ number_format(100 * $exchangeRate, 2) }}
                                (Exchange rate: 1 USD = {{ $exchangeRate }} PKR)
                            </div>
                        @endif
                        @error('amount')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Payment Mode -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-block mb-3">
                            <i class="fas fa-wallet me-2 text-primary"></i>
                            Mode of Payment
                        </label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="paymentMode" id="paymentVoucher"
                                    wire:model="paymentMode" value="voucher">
                                <label class="btn btn-outline-primary w-100 py-3" for="paymentVoucher">
                                    <i class="fas fa-file-invoice me-2"></i> Voucher
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="paymentMode" id="paymentAtm"
                                    wire:model="paymentMode" value="atm">
                                <label class="btn btn-outline-primary w-100 py-3" for="paymentAtm">
                                    <i class="fas fa-money-check-alt me-2"></i> ATM
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="paymentMode" id="paymentOnline"
                                    wire:model="paymentMode" value="online">
                                <label class="btn btn-outline-primary w-100 py-3" for="paymentOnline">
                                    <i class="fas fa-globe me-2"></i> Online
                                </label>
                            </div>
                            {{-- <div class="col-6">
                                <input type="radio" class="btn-check" name="paymentMode" id="paymentForeign"
                                    wire:model="paymentMode" value="foreign">
                                <label class="btn btn-outline-primary w-100 py-3" for="paymentForeign">
                                    <i class="fas fa-exchange-alt me-2"></i> Foreign
                                </label>
                            </div> --}}
                        </div>
                        @error('paymentMode')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($paymentMode === 'voucher' && $isInternational == false)
                        <div class="mb-4 animate__animated animate__fadeIn">
                            <button type="button" class="btn btn-primary w-100 py-3" wire:click="downloadChallan">
                                <i class="fas fa-download me-2"></i> Download Challan Form
                            </button>
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Please download the challan, pay at the bank, and upload the receipt below
                            </div>
                        </div>
                    @endif
                    @if ($paymentMode === 'voucher' && $isInternational == true)
                        <div class="mb-4 animate__animated animate__fadeIn">
                            @if ($isInternational)
                                <div class="alert alert-warning mb-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    International students can pay either $100 or equivalent PKR
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary w-100 py-3"
                                            wire:click="downloadChallan">
                                            <i class="fas fa-download me-2"></i> Download Dollar Challan ($100)
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-primary w-100 py-3"
                                            wire:click="downloadPkrChallan">
                                            <i class="fas fa-download me-2"></i> Download PKR Challan
                                            ({{ number_format(100 * $exchangeRate) }})
                                        </button>
                                    </div>
                                </div>
                            @else
                                <button type="button" class="btn btn-primary w-100 py-3"
                                    wire:click="downloadChallan">
                                    <i class="fas fa-download me-2"></i> Download Challan Form
                                </button>
                            @endif
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Please download the challan, pay at the bank, and upload the receipt below
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="payment-details-container bg-light p-4 rounded h-100">
                        <h5 class="mb-4 text-primary">
                            <i class="fas fa-receipt me-2"></i>
                            Payment Details
                        </h5>

                        <!-- Payment Date -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Date of Payment</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="fas fa-calendar-day text-primary"></i>
                                </span>
                                <input type="date"
                                    class="form-control @error('paymentDate') is-invalid @enderror py-3"
                                    wire:model="paymentDate">
                            </div>
                            @error('paymentDate')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Proof Upload -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Upload Payment Proof</label>
                            <div class="file-upload-wrapper">
                                <input type="file" class="form-control @error('paymentProof') is-invalid @enderror"
                                    wire:model="paymentProof" accept=".pdf,.jpg,.jpeg,.png">
                                <div class="file-upload-message p-3 text-center border rounded">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                    <div class="fw-bold">Click to upload payment receipt</div>
                                    <small class="text-muted">PDF, JPG or PNG (Max 2MB)</small>
                                </div>
                            </div>
                            @error('paymentProof')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Conditional Fields -->
                        @if ($paymentMode === 'foreign' || $paymentMode === 'online' || $paymentMode === 'atm')
                            <div class="mb-4 animate__animated animate__fadeIn">
                                <label class="form-label fw-bold">Transaction ID/Reference</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-hashtag text-primary"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control @error('transactionId') is-invalid @enderror py-3"
                                        wire:model="transactionId" placeholder="Enter transaction reference">
                                </div>
                                @error('transactionId')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        @if ($paymentMode === 'foreign')
                            <div class="mb-3 animate__animated animate__fadeIn">
                                <label class="form-label fw-bold">Payment Details</label>
                                <textarea class="form-control @error('paymentDetails') is-invalid @enderror py-3" wire:model="paymentDetails"
                                    rows="3" placeholder="Additional payment details"></textarea>
                                @error('paymentDetails')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="d-flex justify-content-between mt-5">
                <button type="button" class="btn btn-secondary px-4 py-2 rounded-pill"
                    wire:click="$dispatch('previousStep')">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </button>
                <button type="submit" class="btn btn-success px-4 py-2 rounded-pill">
                    <i class="fas fa-check me-2"></i> Final Submit Application
                </button>
            </div>
        </form>
    </div>
    <style>
        .card {
            border-radius: 0.5rem;
        }

        .btn-group-vertical .btn {
            border-radius: 0.5rem !important;
            margin-bottom: 0.5rem;
            text-align: left;
            transition: all 0.3s ease;
        }

        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary {
            background-color: rgba(13, 110, 253, 0.1);
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .payment-details-container {
            border-left: 4px solid #0d6efd;
            background-color: #f8fafc;
        }

        .file-upload-wrapper {
            position: relative;
        }

        .file-upload-message {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            background-color: white;
        }

        .form-control[type="file"] {
            opacity: 0;
            height: 100%;
            width: 100%;
        }

        .rounded-pill {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .animate__animated {
            animation-duration: 0.3s;
        }

        .input-group-text {
            min-width: 45px;
            justify-content: center;
        }

        .input-group .form-control {
            min-width: 0;
            flex: 1 1 auto;
        }

        .input-group .input-group-text:last-child {
            white-space: nowrap;
        }
    </style>
</div>
