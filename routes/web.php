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
    return view('layouts/app');
});

Route::get('/tabla_incidencia', function () {
    return redirect('/');
});
Auth::routes();

Route::post('/iniciar-sesion','AutenticacionesController@iniciarSesion');
Route::get('/cerrar-sesion','AutenticacionesController@cerrarSesion');
Route::get('/obtener-menu','AutenticacionesController@obtenerMenu');
Route::get('/obtener-incidencias','IncidenciaController@obtenerIncidencia');
Route::post('/insertar-incidencia','IncidenciaController@insertarIncidencia');
Route::post('/editar-descripcion','IncidenciaController@editarDescripcion');
Route::get('/RecibirSms','SMSController@recibirSms');

Route::get('/home', 'HomeController@index')->name('home');
