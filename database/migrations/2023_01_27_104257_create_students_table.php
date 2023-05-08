<?php

use App\Models\Parents;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('panggilan')->nullable();
            $table->enum('gender', ['l', 'p']);
            $table->string('tempat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->unsignedInteger('tinggi_badan')->nullable();
            $table->unsignedInteger('berat_badan')->nullable();
            $table->string('catatan_siswa')->nullable();
            $table->string('foto')->nullable();
            $table->foreignIdFor(Parents::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
