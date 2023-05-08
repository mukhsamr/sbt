<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition()
    {
        return [
            'nik' => fake()->nik(),
            'nama' => fake()->name(),
            'jabatan' => fake()->jobTitle(),
            'tanggal_lahir' => fake()->date()
        ];
    }
}
