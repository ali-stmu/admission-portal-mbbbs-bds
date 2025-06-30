<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PaymentInformation;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
    public $isInternational = false;
    public $exchangeRate = 280; // You can fetch this from an API or database

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
        $this->updatedProgram($this->program);

        // Get authenticated user and set isInternational flag
        $user = auth()->user();
        $this->isInternational = $user && $user->nationality !== 'local';
    }

    public function updatedProgram($value)
    {
        if ($value === 'mbbs' || $value === 'bds') {
            $this->amount = 6000;
        } elseif ($value === 'both') {
            $this->amount = 8000;
        }
    }

public function downloadChallan()
{
    $student = Student::findOrFail($this->studentId);
    $user = auth()->user();
    
    // Convert images to base64 with proper encoding
    $uniLogo = $this->getEncodedImage(public_path('images/uni-logo.png'));
    $bankLogo = $this->getEncodedImage(public_path('images/bank-logo.png'));

    $this->isInternational = $user->nationality !== 'local';
    $currency = $this->isInternational ? 'USD' : 'PKR';
    
    // Determine amount based on program and nationality
    if ($this->isInternational) {
        $amount = 100; // Fixed $100 for international students
    } else {
        // Local student amounts
        if ($this->program === 'mbbs' || $this->program === 'bds') {
            $amount = 6000;
        } elseif ($this->program === 'both') {
            $amount = 8000;
        }
    }
    log::debug($this->isInternational);
    
    $data = [
        'uniLogo' => $uniLogo,
        'bankLogo' => $bankLogo,
        'collegeName' => $this->cleanString('Shifa College of Medicine'),
        'voucherID' => 'STMU-' . time(),
        'date' => now()->format('d-m-Y'),
        'dueDate' => now()->addDays(7)->format('d-m-Y'),
        'AccountTitle' => $this->cleanString('Shifa Tameer-e-Millat University'),
        'bankAccountNumber' => $this->isInternational ? '70120216' : '50007902906303',
        'totalAmount' => $amount,
        'currency' => $currency,
        'amountInWords' => $this->cleanString($this->numberToWords($amount) . ($this->isInternational ? ' Dollars Only' : ' Rupees Only')),
        'studentName' => $this->cleanString($student->name),
        'programName' => $this->cleanString($this->getProgramName()),
        'pyear' => $this->cleanString('2025'),
        'isInternational' => $this->isInternational,
        'bankDetails' => $this->isInternational ? [
            'bankName' => 'Al Baraka Bank (Pakistan) Ltd',
            'swiftCode' => 'AIINPKKA',
            'iban' => 'PK52AIIN0000281073951036',
            'intermediaryBank' => 'Mashreq Bank',
            'intermediarySwift' => 'MSHQUS33'
        ] : [
            'bankName' => 'HABIB BANK LTD',
            'accountTitle' => 'SHIFA TAMEER-MILLAT UNIVERSITY',
            'accountNumber' => '50007902906303'
        ]
    ];

    $pdf = Pdf::loadView('challan', ['data' => $data])
              ->setOption('defaultFont', 'dejavu sans')
              ->setOption('isHtml5ParserEnabled', true)
              ->setOption('isRemoteEnabled', true);
              
    return response()->streamDownload(function() use ($pdf) {
        echo $pdf->stream();
    }, 'payment_challan.pdf');
}


public function downloadPkrChallan()
{
    $student = Student::findOrFail($this->studentId);
    $user = $student->user;
    
    // Convert images to base64 with proper encoding
    $uniLogo = $this->getEncodedImage(public_path('images/uni-logo.png'));
    $bankLogo = $this->getEncodedImage(public_path('images/bank-logo.png'));

    $amount = 100 * $this->exchangeRate; // Convert $100 to PKR
    
    $data = [
        'uniLogo' => $uniLogo,
        'bankLogo' => $bankLogo,
        'collegeName' => $this->cleanString('Shifa College of Medicine'),
        'voucherID' => 'STMU-' . time(),
        'date' => now()->format('d-m-Y'),
        'dueDate' => now()->addDays(7)->format('d-m-Y'),
        'AccountTitle' => $this->cleanString('Shifa Tameer-e-Millat University'),
        'bankAccountNumber' => '50007902906303',
        'totalAmount' => $amount,
        'currency' => 'PKR',
        'amountInWords' => $this->cleanString($this->numberToWords($amount) . ' Rupees Only'),
        'studentName' => $this->cleanString($student->name),
        'programName' => $this->cleanString($this->getProgramName()),
        'pyear' => $this->cleanString('1st Year'),
        'isInternational' => false,
        'bankDetails' => [
            'bankName' => 'HABIB BANK LTD',
            'accountTitle' => 'SHIFA TAMEER-MILLAT UNIVERSITY',
            'accountNumber' => '50007902906303'
        ],
        'foreignNote' => 'Equivalent to USD 100 at exchange rate: 1 USD = ' . $this->exchangeRate . ' PKR'
    ];

    $pdf = Pdf::loadView('challan', ['data' => $data])
              ->setOption('defaultFont', 'dejavu sans')
              ->setOption('isHtml5ParserEnabled', true)
              ->setOption('isRemoteEnabled', true);
              
    return response()->streamDownload(function() use ($pdf) {
        echo $pdf->stream();
    }, 'payment_challan_pkr.pdf');
}

    private function getProgramName()
    {
        return match ($this->program) {
            'mbbs' => 'MBBS',
            'bds' => 'BDS',
            'both' => 'MBBS & BDS',
            default => '',
        };
    }



private function getEncodedImage($path)
{
    if (!file_exists($path)) {
        return '';
    }
    return 'data:image/png;base64,'.base64_encode(file_get_contents($path));
}

private function cleanString($string)
{
    return mb_convert_encoding($string ?? '', 'UTF-8', 'UTF-8');
}

private function numberToWords($number)
{
    $number = (int)$number;
    $hyphen = '-';
    $conjunction = ' and ';
    $separator = ', ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = [
        0 => 'Zero',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety',
        100 => 'Hundred',
        1000 => 'Thousand',
        100000 => 'Lakh',
        10000000 => 'Crore'
    ];

    if ($number < 0) {
        return $negative . $this->numberToWords(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int)($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->numberToWords($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int)($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->numberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->numberToWords($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = [];
        foreach (str_split((string)$fraction) as $digit) {
            $words[] = $dictionary[$digit];
        }
        $string .= implode(' ', $words);
    }

    return $this->cleanString($string);
}
public function save()
{
    $this->validate();

    $paymentProofPath = $this->paymentProof->store('payment-proofs', 'public');

    // Create payment record
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

    // Mark the student application as submitted
    $student = Student::find($this->studentId);
    $student->update(['is_submitted' => true]);

    $this->dispatch('paymentInformationSaved', studentId: $this->studentId);
}

    public function render()
    {
        return view('livewire.payment-information-component');
    }
}