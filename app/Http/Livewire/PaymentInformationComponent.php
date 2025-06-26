<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PaymentInformation;
use App\Models\Student;

class PaymentInformationComponent extends Component
{
    use WithFileUploads;

    public $studentId;
    public $program = 'mbbs';
    public $amount;
    public $paymentMode = 'voucher';
    public $paymentDate;
    public $paymentProof;
    public $transactionId;
    public $paymentDetails;

    protected $rules = [
        'program' => 'required|in:mbbs,bds,both',
        'amount' => 'required|numeric|min:0',
        'paymentMode' => 'required|in:voucher,atm,online,foreign',
        'paymentDate' => 'required|date',
        'paymentProof' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'transactionId' => 'nullable|string|max:100',
        'paymentDetails' => 'nullable|string|max:500',
    ];

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->paymentDate = now()->format('Y-m-d');
    }

    public function updatedProgram($value)
    {
        if ($value === 'mbbs' || $value === 'bds') {
            $this->amount = 6000;
        } elseif ($value === 'both') {
            $this->amount = 8000;
        }
    }

    public function save()
    {
        $this->validate();

        $paymentProofPath = $this->paymentProof->store('payment-proofs', 'public');

        PaymentInformation::create([
            'student_id' => $this->studentId,
            'program' => $this->program,
            'amount' => $this->amount,
            'payment_mode' => $this->paymentMode,
            'payment_date' => $this->paymentDate,
            'payment_proof_path' => $paymentProofPath,
            'transaction_id' => $this->transactionId,
            'payment_details' => $this->paymentDetails,
        ]);

        $this->dispatch('paymentInformationSaved', studentId: $this->studentId);

    }

    public function render()
    {
        return view('livewire.payment-information-component');
    }
}