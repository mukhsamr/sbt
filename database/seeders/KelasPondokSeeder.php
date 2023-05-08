<?php

namespace Database\Seeders;

use App\Models\KelasPondok;
use Illuminate\Database\Seeder;

class KelasPondokSeeder extends Seeder
{
    public function run()
    {
        KelasPondok::insert([
            [
                'kelas' => 1
            ],
            [
                'kelas' => 2
            ],
        ]);
    }
}
