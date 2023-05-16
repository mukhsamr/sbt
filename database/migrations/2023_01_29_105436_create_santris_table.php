<?php

use App\Models\PlpBahasa;
use App\Models\PlpIt;
use App\Models\PlpKarakter;
use App\Models\KelasPayung;
use App\Models\KelasPondok;
use App\Models\Semester;
use App\Models\Student;
use App\Models\PlpTahfidz;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(KelasPondok::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(KelasPayung::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Semester::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('santris');
    }
};
