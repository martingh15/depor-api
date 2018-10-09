<?php

namespace App\Http\Controllers;

use App\Torneo;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    public function getAll()
    {
        return Torneo::all();
    }
}
