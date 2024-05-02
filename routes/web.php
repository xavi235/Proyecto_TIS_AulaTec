<?php

use App\Http\Controllers\AcontecimientoController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\AmbienteHorarioController;
use App\Http\Controllers\HorarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservaController;
use App\Models\Reserva;

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


Route::get('/home', [AmbienteController::class, 'index'])->name('home')->middleware('auth');

Route::resource('Ambiente', AmbienteController::class)->middleware('auth');

Route::resource('Horario', AmbienteHorarioController::class)->middleware('auth');

Route::get('/get-ambientes', [AmbienteController::class, 'getAmbientes'])->name('get.ambientes')->middleware('auth');

Route::get('/ambiente_horarios', [AmbienteHorarioController::class, 'index'])->name('ambiente_horarios.index')->middleware('auth');

Route::get('/Horario/create', [HorarioController::class, 'create'])->name('Horario.create')->middleware('auth');

Route::post('/ambiente_horarios', [AmbienteHorarioController::class, 'store'])->name('ambiente_horarios.store')->middleware('auth');

Route::get('/horario/create', [HorarioController::class, 'create'])->name('Horario.create')->middleware('auth');

Route::put('/Ambiente/{ambiente}', [AmbienteController::class, 'update'])->name('ambiente.update')->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

//USUARIOS
Route::resource('users', 'UserController')
                ->except('create', 'edit')
                ->names('users');

//redireccion ala pagina de docente
Route::view('/docente', 'Docente.docente')->name('docente')->middleware('docente');
Route::get('/solicitud-reserva', [ReservaController::class, 'index'])->name('solicitud_reserva')->middleware('docente');
Route::get('/get-grupos', [ReservaController::class, 'getGrupos'])->name('getGrupos')->middleware('docente');
Route::post('/guardar-solicitud', [ReservaController::class, 'guardarSolicitud'])->name('guardar_solicitud')->middleware('docente');





