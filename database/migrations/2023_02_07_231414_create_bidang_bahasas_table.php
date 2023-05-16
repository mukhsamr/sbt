<?php

use App\Models\PlpBahasa;
use App\Models\Santri;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bidang_bahasas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Santri::class)->unique()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(PlpBahasa::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->enum('kategori', ['l', 'm', 'h'])->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bidang_bahasas');
    }
};
