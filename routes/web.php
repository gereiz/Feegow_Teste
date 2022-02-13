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

Route::get('/', "App\Http\Controllers\AgendamentoController@index");
Route::post('/clinica/agendamento', "App\Http\Controllers\AgendamentoController@store");
Route::get('/clinica/profissionais/{id}', "App\Http\Controllers\AgendamentoController@getProfissionais");
Route::get('/clinica/origens', "App\Http\Controllers\AgendamentoController@getOrigens");

