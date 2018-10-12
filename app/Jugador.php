<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    /* Asigno nombre de tabla al modelo Jugador*/
    protected $table = 'jugadores';

    /* Add the fillable property into the Product Model */ 
    protected $fillable = ['nro_camiseta', 'nombre', 'cantidad_goles', 'cantidad_asistencias','fecha_nacimiento','apodo','posicion'];

    public function asistencia()
    {
        return $this->hasMany('App\Asistencia',"idJugador","nro_camiseta");
    }
}
