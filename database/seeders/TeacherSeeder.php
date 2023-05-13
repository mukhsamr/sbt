<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        Teacher::unguard();

        $path = storage_path('sql/teachers.sql');
        DB::unprepared(file_get_contents($path));
    }
}
