<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
use App\Http\Controllers\UsuarioController;
use App\Http\Requests\ProfileUserRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReporteController;

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
    return view('auth.login');
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
Route::resource('/usuarios', UsuarioController::class);
Route::resource('/reportes', ReporteController::class);

// rutas personalizadas
Route::group(['middleware' => 'auth'], function(){
    //rutas para modifcar perfil
    Route::get('/profile/{usuario}/edit', function($userId){
        return UsuarioController::profile($userId);
    });
    
    Route::put('/profile/{usuario}', function(ProfileUserRequest $request, $userId){
        return UsuarioController::profileUserUpdate($request, $userId);
    });

    Route::put('/password-update/{usuario}', function(PasswordUpdateRequest $request, $userId){
        return UsuarioController::profilePasswordUpdate($request, $userId);
    });

    //rutas para graficas
    Route::get('/datos-grafica/capacitaciones-empleados', function(){
        return HomeController::DataEmpladosPorCapacitacion();
    });

    //rutas para graficas
    Route::get('/datos-grafica/departamentos-empleados', function(){
        return HomeController::DataEmpladosPorDepartamento();
    });

    //rutas para Reportes
    Route::get('/reporte-empleados', function(Request $request){
        return ReporteController::reporteDeEmpleados($request);
    });

    //rutas para Reportes
    Route::get('/reporte-capacitaciones', function(Request $request){
        return ReporteController::reporteCapacitaciones($request);
    });

    //rutas para Reportes
    Route::get('/reporte-departamentos', function(){
        return ReporteController::reporteDepartamentos();
    });

    //rutas para Reportes
    Route::get('/reporte-inversiones', function(){
        return ReporteController::reporteInversion();
    });
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');