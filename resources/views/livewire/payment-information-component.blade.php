<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Payment Information</h4>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <p><strong>Fee Structure:</strong></p>
            <ul class="mb-0">
                <li>Rs. 6,000 for applying to a single program (MBBS or BDS)</li>
                <li>Rs. 8,000 for applying to both programs (MBBS and BDS)</li>
                <li>One-time application fee of USD 100 for international students</li>
            </ul>
        </div>

        <form wire:submit.prevent="save">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Program</label>
                        <select class="form-select @error('program') is-invalid @enderror" wire:model="program">
                            <option value="mbbs">MBBS Only</option>
                            <option value="bds">BDS Only</option>
                            <option value="both">Both MBBS & BDS</option>
                        </select>
                        @error('program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror"
                            wire:model="amount" readonly>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mode of Payment</label>
                        <select class="form-select @error('paymentMode') is-invalid @enderror" wire:model="paymentMode">
                            <option value="voucher">Voucher</option>
                            <option value="atm">ATM</option>
                            <option value="online">Online Transfer</option>
                            <option value="foreign">Foreign Transaction</option>
                        </select>
                        @error('paymentMode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Date of Payment</label>
                        <input type="date" class="form-control @error('paymentDate') is-invalid @enderror"
                            wire:model="paymentDate">
                        @error('paymentDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Payment Proof</label>
                        <input type="file" class="form-control @error('paymentProof') is-invalid @enderror"
                            wire:model="paymentProof">
                        @error('paymentProof')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 2MB, PDF/JPG/PNG format</small>
                    </div>

                    @if ($paymentMode === 'foreign' || $paymentMode === 'online' || $paymentMode === 'atm')
                        <div class="mb-3">
                            <label class="form-label">Transaction ID/Reference</label>
                            <input type="text" class="form-control @error('transactionId') is-invalid @enderror"
                                wire:model="transactionId">
                            @error('transactionId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    @if ($paymentMode === 'foreign')
                        <div class="mb-3">
                            <label class="form-label">Payment Details</label>
                            <textarea class="form-control @error('paymentDetails') is-invalid @enderror" wire:model="paymentDetails" rows="2"></textarea>
                            @error('paymentDetails')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" wire:click="$dispatch('previousStep')">
                    <i class="fas fa-arrow-left me-2"></i> Back
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check me-2"></i> Final Submit
                </button>
            </div>
        </form>
    </div>
</div>
