<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('marca');
            $table->string('modelo');
            $table->integer('anio');
            $table->string('version')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('autos');
    }
}; 