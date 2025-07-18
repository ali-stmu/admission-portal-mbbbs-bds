<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'session',
        'start_date',
        'end_date',
        'is_active',
        'description'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}