<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('entretenimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->string('sistema_infotainment');
            $table->float('pantalla_principal')->nullable();
            $table->boolean('pantalla_secundaria')->default(false);
            $table->string('sistema_sonido');
            $table->integer('numero_parlantes');
            $table->boolean('bluetooth');
            $table->boolean('android_auto');
            $table->boolean('apple_carplay');
            $table->boolean('navegador_gps');
            $table->boolean('cargador_inalambrico');
            $table->integer('puertos_usb');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entretenimiento');
    }
}; 