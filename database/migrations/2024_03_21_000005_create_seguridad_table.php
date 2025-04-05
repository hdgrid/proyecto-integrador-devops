<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('seguridad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->integer('airbags');
            $table->boolean('abs');
            $table->boolean('control_traccion');
            $table->boolean('control_estabilidad');
            $table->boolean('asistente_frenado');
            $table->boolean('monitoreo_presion_neumaticos');
            $table->boolean('camara_reversa');
            $table->boolean('sensores_estacionamiento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seguridad');
    }
}; 