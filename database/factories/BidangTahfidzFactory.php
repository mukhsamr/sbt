<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BidangTahfidzFactory extends Factory
{
    public function definition()
    {
        return [
            'plp_tahfidz_id' => rand(1, 7),
            'kategori' => fake()->randomElement(['l', 'm', 'h'])
        ];
    }
}
