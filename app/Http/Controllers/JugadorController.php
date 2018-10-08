<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jugador;

class JugadorController extends Controller
{

    public function index()
    {
        \Log::info('index');
        return Jugador::all();
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
        $jugador->numero_camiseta = $request->numero_camiseta;
        $jugador->fecha_nacimiento = $request->fecha_nacimiento;
        $jugador->cantidad_goles = $request->cantidad_goles;
        $jugador->cantidad_asistencias = $request->cantidad_asistencias;
        $jugador->apodo = $request->apodo;
        

        $jugador->save();

        if (!empty($jugador->errors())) {
            return Response::json(array(
                'code' => 500,
                'message' => $jugador->errors()
            ), 500);
        }

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

    public function update(Request $request, $id)
    {
        \Log::info('update');
        \Log::info($request);
    }


    public function destroy($id)
    {
        \Log::info('destroy');
    }
}
