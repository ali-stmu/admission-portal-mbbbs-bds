<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'level',
        'school_college',
        'board',
        'year',
        'result_status',
        'maximum_marks',
        'obtained_marks',
        'percentage'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}