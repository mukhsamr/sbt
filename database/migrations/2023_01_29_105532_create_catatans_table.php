<?php

use App\Models\Santri;
use App\Models\Teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('catatans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Santri::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->enum('tipe', ['p', 'n']);
            $table->string('judul');
            $table->foreignIdFor(Teacher::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->longText('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('catatans');
    }
};
