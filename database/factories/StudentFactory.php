<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition()
    {
        $gender = fake()->randomElement(['l', 'p']);
        return [
            'nik' => fake()->nik(),
            'nama' => fake()->name($gender == 'l' ? 'male' : 'female'),
            'panggilan' => fake()->firstName(),
            'gender' => $gender,
            'tempat' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'asal_sekolah' => fake()->company(),
            'tinggi_badan' => rand('140', '190'),
            'berat_badan' => rand('40', '120'),
            'catatan_siswa' => fake()->randomElement([fake()->sentence(), null, null]),
        ];
    }
}
