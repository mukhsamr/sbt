<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::unguard();

        $path = storage_path('sql/users.sql');
        DB::unprepared(file_get_contents($path));
    }
}
