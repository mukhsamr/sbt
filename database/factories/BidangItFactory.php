<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BidangItFactory extends Factory
{
    public function definition()
    {
        return [
            'plp_it_id' => rand(1, 5),
            'kategori' => fake()->randomElement(['l', 'm', 'h'])
        ];
    }
}
