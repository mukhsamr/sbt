<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BidangKarakterFactory extends Factory
{
    public function definition()
    {
        return [
            'plp_karakter_id' => rand(1, 2),
            'kategori' => fake()->randomElement(['l', 'm', 'h'])
        ];
    }
}
