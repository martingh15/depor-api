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
            $table->increments('id');
            $table->bigInteger('nro_partido')->unique();
            $table->string('descripcion');
            $table->date('fecha');
            $table->string('rival');
            $table->bigInteger('goles_a_favor');
            $table->bigInteger('goles_en_contra');
            $table->bigInteger('idTorneo');
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
        Schema::dropIfExists('partidos');
    }
}
