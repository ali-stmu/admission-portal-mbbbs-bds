<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_no',
        'photo_path',
        'name',
        'cnic',
        'cnic_copy_path',
        'gender',
        'dob',
        'mobile',
        'passport_no',
        'passport_copy_path',
        'domicile',
        'email',
        'nationality',
        'province',
        'father_name',
        'father_nic',
        'father_email',
        'father_profession',
        'father_company',
        'father_mobile',
        'father_res_phone',
        'father_office_phone',
        'mailing_address',
        'mailing_house_no',
        'mailing_street',
        'mailing_sector',
        'mailing_tehsil',
        'mailing_city',
        'mailing_country',
        'permanent_address',
        'permanent_house_no',
        'permanent_street',
        'permanent_sector',
        'permanent_tehsil',
        'permanent_city',
        'permanent_country',
        'term_id'
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function academicRecords()
    {
        return $this->hasMany(AcademicRecord::class);
    }

    public function testInformation()
    {
        return $this->hasOne(TestInformation::class);
    }

    public function paymentInformation()
    {
        return $this->hasOne(PaymentInformation::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}