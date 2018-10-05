<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /* Asigno nombre de tabla al modelo Jugador*/
    protected $table = 'usuarios';

    /* Add the fillable property into the Product Model */
    protected $fillable = ['id', 'nombre', 'email', 'password', 'api-token'];
}
