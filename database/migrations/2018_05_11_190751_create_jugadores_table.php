<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('nro_camiseta')->unique();
            $table->string('nombre');
            $table->bigInteger('cantidad_goles')->default(0);
            $table->bigInteger('cantidad_asistencias')->default(0);
            $table->date('fecha_nacimiento');
            $table->string('apodo');
            $table->string('posicion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jugadores');
    }
}
