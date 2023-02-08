<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
 
Route::middleware(['auth'])->group(function () {
    Route::get('/jugadores','App\Http\Controllers\JugadorController@show');
    Route::get('/jugador/editar/{id}','App\Http\Controllers\JugadorController@jugador_editar'); 
    Route::post('jugador/actualizar','App\Http\Controllers\JugadorController@jugador_update'); 
    Route::post('recarga/aprobar','App\Http\Controllers\JugadorController@jugador_aprobar');
    Route::post('recarga/actualizar','App\Http\Controllers\JugadorController@recarga_actualizar');



    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 

});

