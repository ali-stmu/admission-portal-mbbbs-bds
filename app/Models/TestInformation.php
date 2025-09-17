<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestInformation extends Model
{
    use HasFactory;
     protected $table = "test_informations";

    protected $fillable = [
        'student_id',
        'test_type',
        'test_center',
        'test_name',
        'test_score',
        'test_document_path'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}