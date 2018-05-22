<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('jugadores', function () {
//     return response(['Jugador 1', 'Jugador 2', 'Jugador 3'],200);
// });

Route::resource('/jugadores', 'JugadorController');
Route::resource('/partidos', 'PartidoController');
 
// Route::get('jugadores/{jugador}', function ($jugadorId) {
//     return response()->json(['jugadorId' => "{$jugadorId}"], 200);
// });
  
 
// Route::post('jugadores', function() {
//     return  response()->json([
//             'message' => 'Create success'
//         ], 201);
// });
 
// Route::put('jugadores/{jugador}', function() {
//   return  response()->json([
//             'message' => 'Update success'
//         ], 200);
// });
 
// Route::delete('jugadores/{jugador}',function() {
//     return  response()->json(null, 204);
// });