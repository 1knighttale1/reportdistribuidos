<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->date('fecha_partido');
            $table->string('hora_partido');
            $table->integer('estado');
            $table->bigInteger('arbitro_id')->unsigned();
            $table->foreign('arbitro_id')->references('id')->on('arbitros');
            $table->bigInteger('actividad_id')->unsigned();
            $table->foreign('actividad_id')->references('id')->on('actividades');
            $table->bigInteger('local_id')->unsigned();
            $table->foreign('local_id')->references('id')->on('equipos');
            $table->bigInteger('visitante_id')->unsigned();
            $table->foreign('visitante_id')->references('id')->on('equipos');
            $table->integer('goles_local');
            $table->integer('goles_visitante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidos');

    }
}
