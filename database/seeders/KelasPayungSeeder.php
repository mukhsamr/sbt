<?php

namespace Database\Seeders;

use App\Models\KelasPayung;
use Illuminate\Database\Seeder;

class KelasPayungSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        foreach (range(7, 12) as $item) {
            $data[] = ['kelas' => $item];
        }

        KelasPayung::insert($data);
    }
}
