<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Usuario extends Authenticatable implements JWTSubject
{
    /* Asigno nombre de tabla al modelo Jugador*/
    protected $table = 'usuarios';

    /* Add the fillable property into the Product Model */
    protected $fillable = ['id', 'nombreUsuario','password', 'api-token'];

    protected $hidden = ['password'];

    protected $rules = array(
        'nombreUsuario' => 'required',
    );

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
