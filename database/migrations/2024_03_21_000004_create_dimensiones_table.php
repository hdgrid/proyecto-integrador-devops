<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dimensiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->integer('largo');
            $table->integer('ancho');
            $table->integer('alto');
            $table->integer('peso');
            $table->integer('capacidad_tanque');
            $table->integer('capacidad_cajuela');
            $table->integer('distancia_ejes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dimensiones');
    }
}; 