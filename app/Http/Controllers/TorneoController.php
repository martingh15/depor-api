<?php

namespace App\Http\Controllers;

use App\Torneo;
use Illuminate\Http\Request;
use Response;


class TorneoController extends Controller
{
    public function getAll()
    {
        $torneos = Torneo::with('Partido')->get();
        \Log::info($torneos);
        return $torneos;
    }

    public function getOne($idTorneo)
    {

        $torneo = Torneo::where('id',$idTorneo)->with('Partido')->first();
        if (empty($torneo)) {
            return Response::json(array(
                'code' => 500,
                'message' => 'No existe ese torneo'
            ), 500);
        }
        return $torneo;
    }
}