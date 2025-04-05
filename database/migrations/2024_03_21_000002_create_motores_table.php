<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('motores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->string('tipo');
            $table->integer('cilindros');
            $table->decimal('cilindrada', 8, 1);
            $table->integer('potencia');
            $table->integer('torque');
            $table->string('combustible');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('motores');
    }
}; 