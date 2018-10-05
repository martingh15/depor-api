<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jugador;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info('index');
        return Jugador::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        \Log::info('show');
        return Jugador::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \Log::info('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Log::info('update');
        \Log::info($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Log::info('destroy');
    }
}
