<div class="container mt-4">
    <h3>Student Management</h3>

    <div class="input-group mb-3">
        <input type="text" wire:model="search" class="form-control"
            placeholder="Search by name, CNIC, or application no">
        <div class="input-group-append">
            <button wire:click="performSearch" class="btn btn-primary">Search</button>
            <button wire:click="clearSearch" class="btn btn-outline-secondary">Clear</button>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <button wire:click="downloadExcel" class="btn btn-success">Download Excel</button>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="program">Filter by Local Program:</label>
            <select wire:model.lazy="programFilter" class="form-control" id="program">
                <option value="">All Local Programs</option>
                <option value="MBBS">MBBS</option>
                <option value="BDS">BDS</option>
                <option value="both">both</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="intlProgram">Filter by Foreign Program:</label>
            <select wire:model.lazy="intlProgramFilter" class="form-control" id="intlProgram">
                <option value="">All Foreign Programs</option>
                <option value="MBBS">Foreign MBBS</option>
                <option value="BDS">Foreign BDS</option>
                <option value="both">Foreign both</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="specialProgram">Filter by Special Program:</label>
            <select wire:model.lazy="specialProgramFilter" class="form-control" id="specialProgram">
                <option value="">All Special Programs</option>
                <option value="MBBS">Special Foreign MBBS</option>
                <option value="BDS">Special Foreign BDS</option>
                <option value="both">Special Foreign both</option>
            </select>
        </div>
    </div>
    Current filters:
    <strong>{{ $programFilter ? 'Local: ' . $programFilter : '' }}</strong>
    <strong>{{ $intlProgramFilter ? ' | International: ' . $intlProgramFilter : '' }}</strong>
    <strong>{{ $specialProgramFilter ? ' | Special: ' . $specialProgramFilter : '' }}</strong>
    </p>


    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Application No</th>
                <th>CNIC</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Payment Status</th> <!-- New Column -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>
                        @if ($student->photo_path)
                            <img src="{{ asset('storage/' . $student->photo_path) }}" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->application_no }}</td>
                    <td>{{ $student->cnic }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->mobile }}</td>

                    <!-- New Column for Payment Status -->
                    <td>
                        @if ($student->paymentInformation)
                            @if ($student->paymentInformation->payment_verified)
                                <span class="badge-success">Verified</span>
                            @else
                                <span class="badge-warning">Not Verified</span>
                            @endif
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary">Edit</a>

                        @if ($student->paymentInformation)
                            <button wire:click="viewPayment({{ $student->id }})" class="btn btn-sm btn-info">View
                                Payment</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No students found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Payment Info Modal -->
    <div class="modal fade @if ($showPaymentModal) show d-block @endif" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document" style="margin-top: 10%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Information</h5>
                    <button type="button" wire:click="$set('showPaymentModal', false)" class="close">&times;</button>
                </div>
                <div class="modal-body">
                    @if ($payment)
                        <p><strong>Program:</strong> {{ $payment->program }}</p>
                        <p><strong>Amount:</strong> {{ $payment->amount }}</p>
                        <p><strong>Payment Mode:</strong> {{ $payment->payment_mode }}</p>
                        <p><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
                        <p><strong>Payment Date:</strong> {{ $payment->payment_date }}</p>
                        <p><strong>Payment Details:</strong> {{ $payment->payment_details }}</p>
                        @if ($payment->payment_proof_path)
                            <p><strong>Payment Proof:</strong></p>
                            @php
                                $extension = pathinfo($payment->payment_proof_path, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                <img src="{{ asset('storage/' . $payment->payment_proof_path) }}" class="img-fluid"
                                    width="300">
                            @elseif(strtolower($extension) === 'pdf')
                                <iframe src="{{ asset('storage/' . $payment->payment_proof_path) }}" width="100%"
                                    height="500px" style="border:1px solid #ccc;"></iframe>
                            @else
                                <a href="{{ asset('storage/' . $payment->payment_proof_path) }}" target="_blank"
                                    class="btn btn-sm btn-secondary">
                                    View Attachment
                                </a>
                            @endif
                        @endif


                        <div class="mt-3">
                            <button wire:click="verifyPayment({{ $payment->id }})" class="btn btn-success">Verify
                                Payment</button>
                            <button wire:click="$set('showDiscardForm', true)" class="btn btn-danger">Discard
                                Payment</button>
                        </div>

                        @if ($showDiscardForm)
                            <div class="form-group mt-2">
                                <label>Discard Remarks</label>
                                <textarea wire:model.defer="discardRemarks" class="form-control"></textarea>
                                <button wire:click="discardPayment({{ $payment->id }})"
                                    class="btn btn-sm btn-danger mt-2">Submit Discard</button>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>


    {{ $students->links() }}
</div>
