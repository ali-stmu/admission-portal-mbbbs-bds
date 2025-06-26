<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;

class TermSeeder extends Seeder
{
    public function run()
    {
        Term::create([
            'name' => 'Fall 2023',
            'session' => '2023-2024',
            'start_date' => '2023-09-01',
            'end_date' => '2023-12-31',
            'is_active' => true,
            'description' => 'Fall 2023 Admissions for MBBS/BDS programs'
        ]);
    }
}