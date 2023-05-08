<?php

namespace Database\Seeders;

use App\Models\BidangBahasa;
use App\Models\BidangIt;
use App\Models\BidangKarakter;
use App\Models\PlpBahasa;
use App\Models\BidangTahfidz;
use App\Models\Catatan;
use App\Models\PlpIt;
use App\Models\PlpKarakter;
use App\Models\Parents;
use App\Models\Santri;
use App\Models\Student;
use App\Models\PlpTahfidz;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SemesterSeeder::class,
            KelasPondokSeeder::class,
            KelasPayungSeeder::class,
            PlpTahfidzSeeder::class,
            PlpItSeeder::class,
            PlpBahasaSeeder::class,
            PlpKarakterSeeder::class
        ]);

        // PLP
        // PlpIt::factory(5)->create();
        // PlpTahfidz::factory(5)->create();
        // PlpBahasa::factory(5)->create();
        // PlpKarakter::factory(5)->create();


        // Santri
        Teacher::factory(5)
            ->hasUser(1)
            ->create();

        Parents::factory(50)
            ->has(
                Student::factory()->count(1)
                    ->has(
                        Santri::factory()->count(1)
                            ->sequence(fn () => ['semester_id' => 1])
                            ->has(BidangTahfidz::factory()->count(1))
                            ->has(BidangIt::factory()->count(1))
                            ->has(BidangBahasa::factory()->count(1))
                            ->has(BidangKarakter::factory()->count(1))
                            ->has(Catatan::factory()->count(20))
                    )
                    ->has(
                        Santri::factory()->count(1)
                            ->sequence(fn () => ['semester_id' => 2])
                            ->has(BidangTahfidz::factory()->count(1))
                            ->has(BidangIt::factory()->count(1))
                            ->has(BidangBahasa::factory()->count(1))
                            ->has(BidangKarakter::factory()->count(1))
                            ->has(Catatan::factory()->count(20))
                    )
                    ->has(
                        Santri::factory()->count(1)
                            ->sequence(fn () => ['semester_id' => 3])
                            ->has(BidangTahfidz::factory()->count(1))
                            ->has(BidangIt::factory()->count(1))
                            ->has(BidangBahasa::factory()->count(1))
                            ->has(BidangKarakter::factory()->count(1))
                            ->has(Catatan::factory()->count(20))
                    )
            )->create();

        // Punya Saudara
        // Parents::factory(5)->hasStudents(2)->create();
    }
}
