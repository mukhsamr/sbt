<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kelas_pondoks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kelas')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas_pondoks');
    }
};
