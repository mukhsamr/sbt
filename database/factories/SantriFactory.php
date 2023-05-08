<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SantriFactory extends Factory
{
    public function definition()
    {
        return [
            'kelas_pondok_id' => rand(1, 2),
            'kelas_payung_id' => rand(1, 6),
            'level' => fake()->randomElement(['l', 'm', 'h']),
        ];
    }
}
