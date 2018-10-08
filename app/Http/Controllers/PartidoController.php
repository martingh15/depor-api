<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partido;

class PartidoController extends Controller
{

    public function index()
    {
        return Partido::all();
    }

    public function getAll()
    {
        return Partido::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
