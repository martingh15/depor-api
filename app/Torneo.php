<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    /* Asigno nombre de tabla al modelo Jugador*/
    protected $table = 'torneos';

    /* Add the fillable property into the Product Model */
    protected $fillable = ['id', 'fechaTorneo', 'descripcionTorneo','lugar'];

    public function partido()
    {
        return $this->hasMany('App\Partido',"idTorneo","id");
    }
}
