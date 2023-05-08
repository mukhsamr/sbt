<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlpKarakterFactory extends Factory
{
    public function definition()
    {
        return [
            'plp' => fake()->unique()->word(),
        ];
    }
}
