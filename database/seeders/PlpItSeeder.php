<?php

namespace Database\Seeders;

use App\Models\PlpIt;
use Illuminate\Database\Seeder;

class PlpItSeeder extends Seeder
{
    public function run(): void
    {
        PlpIt::insert([
            ['plp' => 'Reguler'],
            ['plp' => 'Aksel'],
            ['plp' => 'ODT 1'],
            ['plp' => 'ODT 2'],
            ['plp' => 'Al-Khawarizmi'],
        ]);
    }
}
