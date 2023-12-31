<?php

use App\Http\Controllers\BacklogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CriteriosController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\EvaluacionesController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\ReqFuncionalesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\ExportController;

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
    Route::resource('calendario', CalendarioController::class);
    Route::resource('criterios', CriteriosController::class);
    Route::resource('requisitos', ReqFuncionalesController::class);
    Route::resource('pruebas', PruebasController::class);
    Route::resource('evaluaciones', EvaluacionesController::class);
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('backlog', BacklogController::class);
    Route::resource('daily', DailyController::class);
    Route::resource('seguimiento', SeguimientoController::class);
    Route::post('/cambiar-contrasena', [UsuariosController::class, 'cambiarContrasena'])->name('cambiar-contrasena');
    Route::get('/exportar/{id}', [ExportController::class, 'export'])->name('exportar');
    Route::get('/pdf/{id}', [SeguimientoController::class, 'prueba'])->name('pdf');
    Route::get('/scrum', [SeguimientoController::class, 'scrum'])->name('scrum');
    Route::post('/daily/cambiar-estado', [DailyController::class, 'actualizarEstado'])->name('actualizarEstado');
    Route::delete('/eliminarUsuario/{id}', [ProyectosController::class, 'destroyUser'])->name('eliminarUsuario');
    Route::get('proyectos/show/{id}', [ProyectosController::class, 'edit'])->name('proyecto-edit');
    Route::get('/crear-correo', [CorreoController::class, 'mostrarFormulario'])->name('crear-correo');
    Route::post('/enviar-correo', [CorreoController::class, 'enviarCorreo'])->name('enviar-correo');

});

Auth::routes();


