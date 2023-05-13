<?php

namespace Database\Seeders;

use App\Models\Parents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentsSeeder extends Seeder
{
    public function run(): void
    {
        Parents::unguard();

        $path = storage_path('sql/parents.sql');
        DB::unprepared(file_get_contents($path));
    }
}
