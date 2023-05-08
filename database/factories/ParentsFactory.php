<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParentsFactory extends Factory
{
    public function definition()
    {
        return [
            'kk' => fake()->nik(),
            'nama_ayah' => fake()->name('male'),
            'nama_ibu' => fake()->name('female'),
            'pekerjaan_ayah' => fake()->jobTitle(),
            'pekerjaan_ibu' => fake()->jobTitle(),
            'jumlah_saudara' => rand(1, 8),
            'alamat' => fake()->address(),
            'catatan_keluarga' => fake()->randomElement([fake()->sentence(), null, null])
        ];
    }
}
