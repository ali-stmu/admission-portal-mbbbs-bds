<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Application Submitted Successfully</h4>
    </div>
    <div class="card-body">
        <div class="alert alert-success">
            <h5 class="alert-heading">Thank you for your application!</h5>
            <p>Your application has been submitted successfully. Please note the following application details:</p>
            <p class="mb-0"><strong>Application No:</strong> {{ $student->application_no }}</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Application Summary</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Term:</strong> {{ $student->term->name }} - {{ $student->term->session }}</p>
                        <p><strong>Applicant Name:</strong> {{ $student->name }}</p>
                        <p><strong>CNIC:</strong> {{ $student->cnic }}</p>
                        <p><strong>Mobile:</strong> {{ $student->mobile }}</p>
                        <p><strong>Email:</strong> {{ $student->email }}</p>
                        <p><strong>Program:</strong> {{ ucfirst($student->paymentInformation->program) }}</p>
                        <p><strong>Application Fee:</strong> Rs.
                            {{ number_format($student->paymentInformation->amount, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Next Steps</h5>
                    </div>
                    <div class="card-body">
                        <ol>
                            <li>Print your application voucher for reference</li>
                            <li>Keep your payment proof safe</li>
                            <li>Check your email regularly for updates</li>
                            @if ($student->testInformation->test_type === 'stmu')
                                <li>You will receive details about your entrance test via email</li>
                            @endif
                        </ol>

                        {{-- <div class="mt-4">
                            <button wire:click="printApplication" class="btn btn-primary me-2">
                                <i class="fas fa-print me-2"></i> Print Application
                            </button>
                            <button wire:click="downloadPdf" class="btn btn-outline-secondary">
                                <i class="fas fa-download me-2"></i> Download PDF
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-warning">
            <h5 class="alert-heading">Important Note</h5>
            <p class="mb-0">Edits to the application form are not allowed after submission. If you need to make any
                changes, please contact the admissions office.</p>
        </div>
    </div>
</div>
