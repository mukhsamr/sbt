<?php

use App\Models\PlpKarakter;
use App\Models\Santri;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bidang_karakters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Santri::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(PlpKarakter::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->enum('kategori', ['l', 'm', 'h']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bidang_karakters');
    }
};
