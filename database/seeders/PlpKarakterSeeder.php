<?php

namespace Database\Seeders;

use App\Models\PlpKarakter;
use Illuminate\Database\Seeder;

class PlpKarakterSeeder extends Seeder
{
    public function run(): void
    {
        PlpKarakter::insert([
            ['plp' => 'PLP 1'],
            ['plp' => 'PLP 2']
        ]);
    }
}
