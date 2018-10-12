<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    /* Asigno nombre de tabla al modelo Jugador*/
    protected $table = 'partidos';

    /* Add the fillable property into the Product Model */
    protected $fillable = ['nro_partido', 'descripcion', 'fecha', 'rival', 'goles_a_favor', 'goles_en_contra','idTorneo'];

    public function asistencia()
    {
        return $this->hasMany('App\Asistencia',"idPartido","nro_partido");
    }
}
