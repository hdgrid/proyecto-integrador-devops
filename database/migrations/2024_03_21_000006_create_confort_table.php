<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('confort', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->boolean('aire_acondicionado');
            $table->boolean('climatizador');
            $table->boolean('asientos_calefactables');
            $table->boolean('asientos_electricos');
            $table->boolean('techo_solar');
            $table->boolean('volante_multifuncion');
            $table->boolean('control_crucero');
            $table->boolean('encendido_sin_llave');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('confort');
    }
}; 