<?php

namespace Database\Seeders;

use App\Models\PlpBahasa;
use Illuminate\Database\Seeder;

class PlpBahasaSeeder extends Seeder
{
    public function run(): void
    {
        PlpBahasa::insert([
            ['plp' => 'Reguler'],
            ['plp' => 'Aksel'],
        ]);
    }
}
