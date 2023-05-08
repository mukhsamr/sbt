<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tahun' => '2022-2023',
                'semester' => 1,
                'is_active' => 0,
            ],
            [
                'tahun' => '2022-2023',
                'semester' => 2,
                'is_active' => 0,
            ],
            [
                'tahun' => '2023-2024',
                'semester' => 2,
                'is_active' => 1,
            ],
        ];

        Semester::insert($data);
    }
}
