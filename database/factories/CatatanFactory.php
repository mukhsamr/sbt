<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CatatanFactory extends Factory
{
    public function definition()
    {
        return [
            'tipe' => fake()->randomElement(['p', 'n']),
            'judul' => fake()->word(),
            'teacher_id' => rand(1, 5),
            'catatan' => fake()->sentence()
        ];
    }
}
