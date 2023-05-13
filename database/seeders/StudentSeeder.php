<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::unguard();

        $path = storage_path('sql/students.sql');
        DB::unprepared(file_get_contents($path));
    }
}
