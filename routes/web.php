<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\NivelAcademicoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\FinanciamientoController;
use App\Http\Controllers\CapacitacionController;
use App\Http\Controllers\FinanciamientoCapacitacionController;
use App\Http\Controllers\FechasCapacitacionController;
use App\Http\Controllers\EstadoCapacitacionController;
use App\Http\Controllers\CapacitacionEmpleadoController;

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

Route::get('/home', function () {
    return view('home.index');
});

Route::resource('/cargos', CargoController::class);
Route::resource('/nivel_academico', NivelAcademicoController::class);
Route::resource('/departamentos', DepartamentoController::class);
Route::resource('/empleados', EmpleadoController::class);
Route::resource('/financiamientos', FinanciamientoController::class);
Route::resource('/capacitaciones', CapacitacionController::class);
Route::resource('/financiamiento_capacitacion', FinanciamientoCapacitacionController::class);
Route::resource('/horario_capacitacion', FechasCapacitacionController::class);
Route::resource('/estados',EstadoCapacitacionController::class);
Route::resource('/inscripciones', CapacitacionEmpleadoController::class);