<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Response;

class UsuarioController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function store(Request $request) {
        $bodyContent = json_decode($request->getContent(), true);
        $usuarioGuardado = Usuario::where('nombreUsuario',$bodyContent['nombreUsuario'])->first();

        if(!empty($usuarioGuardado)) {
            return Response::json(array(
                'code' => 500,
                'message' => "Ya existe un usuario con ese nombre."
            ), 500);
        }

        $usuario = new Usuario();
        $usuario->nombreUsuario = $bodyContent['nombreUsuario'];
        $usuario->password = Hash::make($bodyContent['password']);
        $usuario->save();

        return Response::json(array(
            'code' => 200,
            'message' => "Usuario creado correctamente."
        ), 200);
    }
}
