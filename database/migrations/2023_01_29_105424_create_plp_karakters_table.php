<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plp_karakters', function (Blueprint $table) {
            $table->id();
            $table->string('plp')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plp_karakter');
    }
};
