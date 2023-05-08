<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlpTahfidzFactory extends Factory
{
    public function definition()
    {
        return [
            'plp' => fake()->unique()->word(),
        ];
    }
}
