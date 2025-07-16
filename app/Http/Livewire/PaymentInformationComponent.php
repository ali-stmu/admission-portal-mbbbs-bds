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
    public $program = 'mbbs'; // For local students
    public $localProgram; // For international students
    public $intlProgram; // For international students
    public $specialProgram; // For international students
    public $amount;
    public $paymentMode = 'voucher';
    public $paymentDate;
    public $paymentProof;
    public $transactionId;
    public $paymentDetails;
    public $isInternational = false;
    public $exchangeRate = 280;

    protected function rules()
{
    $rules = [
        'amount' => 'required|numeric|min:0',
        'paymentMode' => 'required|in:voucher,atm,online,foreign',
        'paymentDate' => 'required|date',
        'paymentProof' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'transactionId' => 'nullable|string|max:100',
        'paymentDetails' => 'nullable|string|max:500',
    ];

    if ($this->isInternational) {
        $rules['localProgram'] = 'required|in:mbbs,bds,both';
        $rules['intlProgram'] = 'required|in:intl_mbbs,intl_bds,intl_both';
        $rules['specialProgram'] = 'required|in:special_mbbs,special_bds,special_both';
    } else {
        $rules['program'] = 'required|in:mbbs,bds,both';
    }

    return $rules;
}
public function mount($studentId)
{
    $this->studentId = $studentId;
    $this->paymentDate = now()->format('Y-m-d');
    
    $user = auth()->user();
    $this->isInternational = $user && $user->nationality !== 'local';
    
    if ($this->isInternational) {
        $this->amount = 100; // Fixed $100 for international students
        // Initialize international program fields
        $this->localProgram = 'mbbs';
        $this->intlProgram = 'intl_mbbs';
        $this->specialProgram = 'special_mbbs';
    } else {
        $this->program = 'mbbs'; // Default for local students
        $this->updatedProgram($this->program);
    }
}

    public function updatedProgram($value)
    {
        if (!$this->isInternational) {
            if ($value === 'mbbs' || $value === 'bds') {
                $this->amount = 6000;
            } elseif ($value === 'both') {
                $this->amount = 8000;
            }
        }
    }

    public function downloadChallan()
    {
        $student = Student::findOrFail($this->studentId);
        $user = auth()->user();
        
        $uniLogo = $this->getEncodedImage(public_path('assets/img/ShifaLogo.png'));

$bankLogoPath = $this->isInternational
    ? public_path('assets/img/2560px-Al_Baraka_logo.png')
    : public_path('assets/img/HBL-logo.jpg');

$bankLogo = $this->getEncodedImage($bankLogoPath);



        $currency = $this->isInternational ? 'USD' : 'PKR';
        $amount = $this->isInternational ? 100 : $this->amount;
        
        $data = [
            'uniLogo' => $uniLogo,
            'bankLogo' => $bankLogo,
            'collegeName' => $this->cleanString('Shifa College of Medicine'),
            'voucherID' => 'STMU-' . time(),
            'date' => now()->format('d-m-Y'),
            'dueDate' => \Carbon\Carbon::create(2025, 7, 28)->format('d-m-Y'),
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
        $amount = 100 * $this->exchangeRate;
        
        $uniLogo = $this->getEncodedImage(public_path('assets/img/ShifaLogo.png'));

$bankLogoPath = $this->isInternational
    ? public_path('assets/img/2560px-Al_Baraka_logo.png')
    : public_path('assets/img/HBL-logo.jpg');

$bankLogo = $this->getEncodedImage($bankLogoPath);



        $data = [
            'uniLogo' => $uniLogo,
            'bankLogo' => $bankLogo,
            'collegeName' => $this->cleanString('Shifa College of Medicine'),
            'voucherID' => 'STMU-' . time(),
            'date' => now()->format('d-m-Y'),
            'dueDate' => \Carbon\Carbon::create(2025, 7, 28)->format('d-m-Y'),
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
        if ($this->isInternational) {
            $localName = match ($this->localProgram) {
                'mbbs' => 'Local MBBS',
                'bds' => 'Local BDS',
                'both' => 'Local MBBS & BDS',
                default => '',
            };
            
            $intlName = match ($this->intlProgram) {
                'intl_mbbs' => 'International MBBS',
                'intl_bds' => 'International BDS',
                'intl_both' => 'International MBBS & BDS',
                default => '',
            };
            
            $specialName = match ($this->specialProgram) {
                'special_mbbs' => 'Special MBBS',
                'special_bds' => 'Special BDS',
                'special_both' => 'Special MBBS & BDS',
                default => '',
            };
            
            return implode(' + ', array_filter([$localName, $intlName, $specialName]));
        } else {
            return match ($this->program) {
                'mbbs' => 'MBBS',
                'bds' => 'BDS',
                'both' => 'MBBS & BDS',
                default => '',
            };
        }
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

// In the save method
public function save()
{
    $this->validate();

    // Prepare program data
    $programValue = $this->isInternational 
        ? json_encode([
            'local' => $this->localProgram,
            'international' => $this->intlProgram,
            'special' => $this->specialProgram
        ])
        : $this->program;

    // Prepare filename with program info
    $originalName = pathinfo($this->paymentProof->getClientOriginalName(), PATHINFO_FILENAME);
    $extension = $this->paymentProof->getClientOriginalExtension();
    
    $programInfo = $this->isInternational 
        ? "intl-{$this->localProgram}-{$this->intlProgram}-{$this->specialProgram}"
        : "local-{$this->program}";
    
    $filename = "payment-{$this->studentId}-{$programInfo}-" . time() . ".{$extension}";

    $paymentProofPath = $this->paymentProof->storeAs('payment-proofs', $filename, 'public');

    // Create payment record
    $paymentData = [
        'student_id' => $this->studentId,
        'program' => $programValue,
        'amount' => $this->amount,
        'payment_mode' => $this->paymentMode,
        'payment_date' => $this->paymentDate,
        'payment_proof_path' => $paymentProofPath,
        'transaction_id' => $this->transactionId,
        'payment_details' => $this->paymentDetails,
    ];

    // Only include these fields for international students
    if ($this->isInternational) {
        $paymentData['local_program'] = $this->localProgram;
        $paymentData['intl_program'] = $this->intlProgram;
        $paymentData['special_program'] = $this->specialProgram;
    }

    PaymentInformation::create($paymentData);

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