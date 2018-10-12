<?php

namespace App\Http\Controllers;

use App\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        return Asistencia::all();
    }
}
