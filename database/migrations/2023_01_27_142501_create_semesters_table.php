<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->string('semester');
            $table->boolean('is_active')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('semesters');
    }
};
