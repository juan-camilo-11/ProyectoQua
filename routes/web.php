<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\CriteriosController;
use App\Http\Controllers\EvaluacionesController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\ReqFuncionalesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});


Route::middleware(['auth'])->group(function () {
    // Aquí van todas las rutas autenticadas
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('proyectos', ProyectosController::class);
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::post('/proyectos/agregar-miembro', [ProyectosController::class, 'agregarMiembroProyecto'])->name('proyectos.agregar-miembro');
    Route::resource('criterios', CriteriosController::class);
    Route::resource('requisitos', ReqFuncionalesController::class);
    Route::resource('pruebas', PruebasController::class);
    Route::resource('evaluaciones', EvaluacionesController::class);
});

Auth::routes();


