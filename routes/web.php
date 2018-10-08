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

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::resource('/jugadores', 'JugadorController');
    Route::resource('/partidos', 'PartidoController');
    Route::resource('/usuarios', 'UsuarioController');

});

Route::get('/allJugadores', 'JugadorController@getAll');
Route::get('/allPartidos', 'PartidoController@getAll');
Route::post("/loginWeb", 'LoginController@loginWeb');
