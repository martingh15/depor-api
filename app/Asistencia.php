<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    /* Asigno nombre de tabla al modelo Jugador*/
    protected $table = 'asistencias';

    /* Add the fillable property into the Product Model */
    protected $fillable = ['idPartido','idJugador'];
}
