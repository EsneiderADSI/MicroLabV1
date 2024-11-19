<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->dateTime('fecha_hora');
            $table->decimal('practica1', 5, 2)->nullable();
            $table->decimal('practica2', 5, 2)->nullable();
            $table->decimal('practica3', 5, 2)->nullable();
            $table->decimal('practica4', 5, 2)->nullable();
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacions');
    }
}
