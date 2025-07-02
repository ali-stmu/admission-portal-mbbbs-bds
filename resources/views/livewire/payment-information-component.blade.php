<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0 d-flex align-items-center">
            <i class="fas fa-credit-card me-2"></i>
            Payment Information
        </h4>
    </div>
    <div class="card-body p-4" x-data="{ selectedPaymentMode: '{{ $paymentMode }}' }">
        <!-- Fee Structure -->
        <div class="alert alert-info d-flex align-items-start">
            <i class="fas fa-info-circle fa-2x me-3 mt-1"></i>
            <div>
                <h5 class="alert-heading mb-3">Fee Structure</h5>
                <ul class="mb-0 list-unstyled">
                    <li class="mb-2 d-flex">
                        <span class="badge bg-primary rounded-pill me-3">1</span>
                        <span>Rs. 6,000 for applying to a single program (MBBS or BDS)</span>
                    </li>
                    <li class="mb-2 d-flex">
                        <span class="badge bg-primary rounded-pill me-3">2</span>
                        <span>Rs. 8,000 for applying to both programs (MBBS and BDS)</span>
                    </li>
                    <li class="d-flex">
                        <span class="badge bg-primary rounded-pill me-3">3</span>
                        <span>One-time application fee of USD 100 for international students</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Form Starts -->
        <form wire:submit.prevent="save">
            <div class="row g-4">
                <div class="col-md-6">
                    <!-- Program Selection Section -->
                    <!-- Keep your program selection code here -->
                    <!-- ... (Skipped for brevity - keep your existing program selection section unchanged) -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-block mb-3">
                            <i class="fas fa-graduation-cap me-2 text-primary"></i>
                            Select Program
                        </label>

                        @if ($isInternational)
                            <!-- International Student Options (all 9 options) -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-muted mb-3">Local Programs (select one)</h6>
                                <div class="btn-group-vertical w-100" role="group">
                                    <input type="radio" class="btn-check" name="localProgram" id="localMbbs"
                                        wire:model="localProgram" value="mbbs">
                                    <label class="btn btn-outline-primary text-start py-3" for="localMbbs">
                                        <i class="fas fa-user-md me-2"></i>
                                        <strong>Local MBBS</strong>
                                    </label>

                                    <input type="radio" class="btn-check" name="localProgram" id="localBds"
                                        wire:model="localProgram" value="bds">
                                    <label class="btn btn-outline-primary text-start py-3" for="localBds">
                                        <i class="fas fa-tooth me-2"></i>
                                        <strong>Local BDS</strong>
                                    </label>

                                    <input type="radio" class="btn-check" name="localProgram" id="localBoth"
                                        wire:model="localProgram" value="both">
                                    <label class="btn btn-outline-primary text-start py-3" for="localBoth">
                                        <i class="fas fa-clipboard-list me-2"></i>
                                        <strong>Local Both MBBS & BDS</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold text-muted mb-3">FOREIGN Programs (select one)</h6>
                                <div class="btn-group-vertical w-100" role="group">
                                    <input type="radio" class="btn-check" name="intlProgram" id="intlMbbs"
                                        wire:model="intlProgram" value="intl_mbbs">
                                    <label class="btn btn-outline-primary text-start py-3" for="intlMbbs">
                                        <i class="fas fa-user-md me-2"></i>
                                        <strong>FOREIGN MBBS</strong>
                                    </label>

                                    <input type="radio" class="btn-check" name="intlProgram" id="intlBds"
                                        wire:model="intlProgram" value="intl_bds">
                                    <label class="btn btn-outline-primary text-start py-3" for="intlBds">
                                        <i class="fas fa-tooth me-2"></i>
                                        <strong>FOREIGN BDS</strong>
                                    </label>

                                    <input type="radio" class="btn-check" name="intlProgram" id="intlBoth"
                                        wire:model="intlProgram" value="intl_both">
                                    <label class="btn btn-outline-primary text-start py-3" for="intlBoth">
                                        <i class="fas fa-clipboard-list me-2"></i>
                                        <strong>FOREIGN Both MBBS & BDS</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold text-muted mb-3">Special Programs (select one)</h6>
                                <div class="btn-group-vertical w-100" role="group">
                                    <input type="radio" class="btn-check" name="specialProgram" id="specialMbbs"
                                        wire:model="specialProgram" value="special_mbbs">
                                    <label class="btn btn-outline-primary text-start py-3" for="specialMbbs">
                                        <i class="fas fa-user-md me-2"></i>
                                        <strong>Special FOREIGN MBBS</strong>
                                    </label>

                                    <input type="radio" class="btn-check" name="specialProgram" id="specialBds"
                                        wire:model="specialProgram" value="special_bds">
                                    <label class="btn btn-outline-primary text-start py-3" for="specialBds">
                                        <i class="fas fa-tooth me-2"></i>
                                        <strong>Special FOREIGN BDS</strong>
                                    </label>

                                    <input type="radio" class="btn-check" name="specialProgram" id="specialBoth"
                                        wire:model="specialProgram" value="special_both">
                                    <label class="btn btn-outline-primary text-start py-3" for="specialBoth">
                                        <i class="fas fa-clipboard-list me-2"></i>
                                        <strong>Special FOREIGN Both MBBS & BDS</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="alert alert">
                                <i class="fas fa-info-circle me-2"></i>
                                International students will pay a fixed fee of $100 regardless of program selection
                            </div>
                        @else
                            <!-- Local Student Options (only 3 options) -->
                            <div class="btn-group-vertical w-100" role="group">
                                <input type="radio" class="btn-check" name="program" id="programMbbs"
                                    wire:model="program" value="mbbs">
                                <label class="btn btn-outline-primary text-start py-3" for="programMbbs">
                                    <i class="fas fa-user-md me-2"></i>
                                    <strong>MBBS Only</strong>
                                    <span class="badge bg-primary float-end">
                                        Rs. 6,000
                                    </span>
                                </label>

                                <input type="radio" class="btn-check" name="program" id="programBds"
                                    wire:model="program" value="bds">
                                <label class="btn btn-outline-primary text-start py-3" for="programBds">
                                    <i class="fas fa-tooth me-2"></i>
                                    <strong>BDS Only</strong>
                                    <span class="badge bg-primary float-end">
                                        Rs. 6,000
                                    </span>
                                </label>

                                <input type="radio" class="btn-check" name="program" id="programBoth"
                                    wire:model="program" value="both">
                                <label class="btn btn-outline-primary text-start py-3" for="programBoth">
                                    <i class="fas fa-clipboard-list me-2"></i>
                                    <strong>Both MBBS & BDS</strong>
                                    <span class="badge bg-primary float-end">
                                        Rs. 8,000
                                    </span>
                                </label>
                            </div>
                        @endif

                        @error('program')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('localProgram')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('intlProgram')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('specialProgram')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Amount Payable -->
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
                                wire:model="amount" readonly style="background-color: #f8f9fa;">
                            <span class="input-group-text bg-white">
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
                                    wire:model="paymentMode" value="voucher"
                                    @click="selectedPaymentMode = 'voucher'">
                                <label class="btn btn-outline-primary w-100 py-3" for="paymentVoucher">
                                    <i class="fas fa-file-invoice me-2"></i> Voucher
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="paymentMode" id="paymentAtm"
                                    wire:model="paymentMode" value="atm" @click="selectedPaymentMode = 'atm'">
                                <label class="btn btn-outline-primary w-100 py-3" for="paymentAtm">
                                    <i class="fas fa-money-check-alt me-2"></i> ATM/Online
                                </label>
                            </div>
                            {{-- <div class="col-6">
                                <input type="radio" class="btn-check" name="paymentMode" id="paymentOnline"
                                    wire:model="paymentMode" value="online" @click="selectedPaymentMode = 'online'">
                                <label class="btn btn-outline-primary w-100 py-3" for="paymentOnline">
                                    <i class="fas fa-globe me-2"></i> Online
                                </label>
                            </div> --}}
                        </div>
                        @error('paymentMode')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Voucher Section -->
                    <div class="mb-4 animate__animated animate__fadeIn" x-show="selectedPaymentMode === 'voucher'">
                        <button type="button" class="btn btn-primary w-100 py-3" wire:click="downloadChallan">
                            <i class="fas fa-download me-2"></i> Download Challan Form
                        </button>
                        <button type="button" class="btn btn-outline-primary w-100 py-3"
                            wire:click="downloadPkrChallan">
                            <i class="fas fa-download me-2"></i> Download PKR Challan
                            ({{ number_format(100 * $exchangeRate) }})
                        </button>
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Please download the challan, pay at the bank, and upload the receipt below
                        </div>
                    </div>

                    <!-- ATM / Online Transaction ID -->
                    <template x-if="selectedPaymentMode === 'atm' || selectedPaymentMode === 'online'">
                        <div class="card bg-primary text-white mb-4 animate__animated animate__fadeIn shadow">
                            <div class="card-header fw-bold">Banking Details</div>
                            <div class="card-body" style="white-space: pre-line">
                                For Foreign Category Seats - MBBS/BDS
                                HABIB BANK LTD – FOR MBBS/BDS Local Seats
                                <strong>CMD ACCOUNT NO:</strong> 50007902906303
                                <strong>ACCOUNT TITLE:</strong> SHIFA TAMEER-MILLAT UNIVERSITY
                                <strong>BANK NAME:</strong> HBL

                                <strong>Currency:</strong> USD

                                <u>Intermediary - Name/Address (Field 56 D)</u>
                                Mashreq Bank
                                <strong>SWIFT CODE:</strong> MSHQUS33

                                <u>Account with Institution (Field 57 D)</u>
                                <strong>Account Number:</strong> 70120216
                                <strong>Title:</strong> Al Baraka Bank (Pakistan) Ltd
                                <strong>SWIFT:</strong> AIINPKKA

                                <u>Beneficiary Customer (Field 59)</u>
                                <strong>IBAN:</strong> PK52AIIN0000281073951036
                                <strong>Title:</strong> SHIFA TAMEER-E-MILLAT UNIVERSITY
                            </div>
                        </div>

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


                    </template>
                </div>

                <!-- Right Column -->
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

                        <!-- Upload Proof -->
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

    <!-- Styling -->
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
