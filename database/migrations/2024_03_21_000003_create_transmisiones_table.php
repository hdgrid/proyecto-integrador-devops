<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transmisiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->string('tipo');
            $table->string('traccion');
            $table->integer('marchas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transmisiones');
    }
}; 