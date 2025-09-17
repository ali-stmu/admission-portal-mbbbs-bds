<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInformation extends Model
{
    use HasFactory;
    protected $table = "payment_informations";


    protected $fillable = [
        'student_id',
        'program',
        'local_program',
        'intl_program',
        'special_program',
        'amount',
        'payment_mode',
        'payment_date',
        'payment_proof_path',
        'transaction_id',
        'payment_details',
        'is_international',
        'payment_verified',
        'discard_remarks'
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}