<?php

namespace Database\Seeders;

use App\Models\PlpTahfidz;
use Illuminate\Database\Seeder;

class PlpTahfidzSeeder extends Seeder
{
    public function run(): void
    {
        PlpTahfidz::insert([
            ['plp' => 'PLP 0'],
            ['plp' => 'PLP 1'],
            ['plp' => 'PLP 2'],
            ['plp' => 'PLP 3'],
            ['plp' => 'PLP 4'],
            ['plp' => 'PLP 5'],
            ['plp' => 'PLP 6'],
        ]);
    }
}
