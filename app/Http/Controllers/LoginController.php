<?php

namespace App\Http\Controllers;

use App\Mail\OlvidoPassword;
use App\Rol;
use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use JWTAuth;
use JWTFactory;
use Response;
use App\Producto;

class LoginController extends Controller
{
    public function __construct()
    {
        //$this->middleware('jwt.auth', ['except' => ['login']]);
    }


    public function loginWeb(Request $request)
    {
        // credenciales para loguear al usuario
        $credentials = $request->only('email', 'password');

        try {
            //Busco por mail
            $user = Usuario::where("email", $credentials['email'])->first();
            if (empty($user)) {
                return Response::json(array(
                    'code' => 500,
                    'message' => "Usuario y/o contraseña incorrectos."
                ), 500);
            }
            //Verifico password
            if (!Hash::check($credentials['password'], $user->password)) {
                return Response::json(array(
                    'code' => 500,
                    'message' => "Usuario y/o contraseña incorrectos."
                ), 500);
            }
            //Genero token
            $token = JWTAuth::fromUser($user, ['idUsuario' => $user->id, 'nombre' => $user->nombre]);
            //Si hubo problema con token
            if (!$token) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // si no se puede crear el token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'))->header('Access-Control-Allow-Origin', '*');

    }

    public function loginMon(Request $request)
    {
        // credenciales para loguear al usuario
        $credentials = $request->only('email', 'password');

        try {
            //Busco por mail
            $user = Usuario::where("email", $credentials['email'])->first();
            if (empty($user)) {
                //Busco por tarjeta
                $user = Usuario::where([["tarjeta", $credentials['email']]])->first();
            }
            if (empty($user)) {
                return Response::json(array(
                    'code' => 500,
                    'message' => "Usuario y/o contraseña incorrectos."
                ), 500);
            }
            //Me fijo si esta habilitado
            if ($user->estado == 0) {
                return Response::json(array(
                    'code' => 500,
                    'message' => "Su usuario no ha sido habilitado aún. Aguarde la habilitación o contáctese con nosotros."
                ), 500);
            }
            if ($user->idRol != config('constants.IDSROLES.ID_ADMINISTRACION') &&
                $user->idRol != config('constants.IDSROLES.ID_DESPACHO') &&
                $user->idRol != config('constants.IDSROLES.ID_VENDEDOR') &&
                $user->idRol != config('constants.IDSROLES.ID_COMMUNITY_MANAGER') &&
                $user->idRol != config('constants.IDSROLES.ID_ADMINISTRADOR')) {
                return Response::json(array(
                    'code' => 500,
                    'message' => "No posee permisos para ingresar al sistema"
                ), 500);
            }
            //Verifico password
            if (!Hash::check($credentials['password'], $user->password)) {
                return Response::json(array(
                    'code' => 500,
                    'message' => "Usuario y/o contraseña incorrectos."
                ), 500);
            }
            $rol = Rol::find($user->idRol);
            //Genero token
            $token = JWTAuth::fromUser($user, ['rol' => !empty($rol) ? $rol->desRol : "", 'idRol' => $user->idRol, 'nombre' => $user->nombre . " " . $user->apellido, 'id' => uniqid()]);
            //Si hubo problema con token
            if (!$token) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // si no se puede crear el token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'))->header('Access-Control-Allow-Origin', '*');

    }

    public function olvidoPassword(Request $request)
    {
        //Obtengo mail del body
        $bodyContent = json_decode($request->getContent(), true);
        //Busco usuario que coincida con el mail
        $user = Usuario::where("email", $bodyContent['email'])->first();
        if (empty($user))
            return Response::json(array(
                'code' => 500,
                'message' => "El email ingresado no corresponde a ningún usuario registrado."
            ), 500);

        //Genero token
        $tokenReset = str_random(64);
        $fechaExpiraToken = (new \DateTime())->setTimezone(new \DateTimeZone("America/Argentina/Buenos_Aires"));
        $fechaExpiraToken->add(new \DateInterval('PT' . 60 . 'M'));

        //Guardo token y fecha expira
        $user->tokenReset = $tokenReset;
        $user->fechaExpiraToken = $fechaExpiraToken;
        $user->save();

        Mail::to($user->email, "Kit Experto")->send(new OlvidoPassword($user));
    }

    public function resetPassword(Request $request)
    {
        //Obtengo mail del body
        $bodyContent = json_decode($request->getContent(), true);
        //Busco usuario que coincida con el token y fecha
        $fechaHoy = (new \DateTime())->setTimezone(new \DateTimeZone("America/Argentina/Buenos_Aires"));
        $user = Usuario::where([["tokenReset", $bodyContent['tokenReset']], ["fechaExpiraToken", ">=", $fechaHoy]])->first();
        if (empty($user))
            return Response::json(array(
                'code' => 500,
                'message' => "El token ingresado no es válido o ha caducado."
            ), 500);
        if (!empty($bodyContent["password"]))
            $user->password = Hash::make($bodyContent['password']);
        $user->tokenReset = null;
        $user->fechaExpiraToken = null;
        $user->save();
    }

    public function validarToken(Request $request)
    {
        //Obtengo mail del body
        $bodyContent = json_decode($request->getContent(), true);
        //Busco usuario que coincida con el token y fecha
        $fechaHoy = (new \DateTime())->setTimezone(new \DateTimeZone("America/Argentina/Buenos_Aires"));
        $user = Usuario::where([["tokenReset", $bodyContent['tokenReset']], ["fechaExpiraToken", ">=", $fechaHoy]])->first();
        if (empty($user))
            return Response::json(array(
                'code' => 500,
                'message' => "El token ingresado no es válido o ha caducado."
            ), 500);
    }
}
