<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jugador;
use Response;

class JugadorController extends Controller
{

    public function index()
    {
        \Log::info('index');
        return Jugador::all();
    }

    public function getOne($nro_camiseta)
    {
        $jugador = Jugador::where('nro_camiseta',$nro_camiseta)->first();

        if (empty($jugador)) {
            return Response::json(array(
                'code' => 500,
                'message' => 'No existe ese jugador'
            ), 500);
        }

        return $jugador;


    }
    public function getAll()
    {
        return Jugador::all();
    }

    public function create()
    {
        \Log::info('create');
    }

    public function store(Request $request)
    {
        \Log::info('store');
        $jugador = new Jugador;

        $jugador->nombre = $request->nombre;
        $jugador->nro_camiseta = $request->nro_camiseta;
        $jugador->fecha_nacimiento = $request->fecha_nacimiento;
        $jugador->cantidad_goles = 0;
        $jugador->cantidad_asistencias = 0;
        $jugador->posicion = $request->posicion;
        $jugador->apodo = $request->apodo;

        $jugadorDuplicado = Jugador::where('nro_camiseta',$request->nro_camiseta)->first();

        if (!empty($jugadorDuplicado)) {
            return Response::json(array(
                'code' => 500,
                'message' => 'El jugador con ese numero de camiseta ya existe, es: ' . $jugadorDuplicado->nombre
            ), 500);
        }

        $jugador->save();

        return $jugador;
    }

    public function show($id)
    {
        \Log::info('show');
        return Jugador::find($id);
    }

    public function edit($id)
    {
        \Log::info('edit');
    }

    public function update(Request $request, $nro_camiseta)
    {
        \Log::info('update');
        $jugador = Jugador::where('nro_camiseta', $nro_camiseta)->first();
        $jugador->nombre = $request->nombre;
        $jugador->nro_camiseta = $request->nro_camiseta;
        $jugador->fecha_nacimiento = $request->fecha_nacimiento;
        $jugador->posicion = $request->posicion;
        $jugador->apodo = $request->apodo;
        $jugador->save();

        return $jugador;
    }


    public function destroy($nro_camiseta)
    {
        $jugador = Jugador::where('nro_camiseta',$nro_camiseta)->first();
        $jugador->delete();

        return 'Jugador con camiseta ' . $nro_camiseta .' borrado';
    }
}
