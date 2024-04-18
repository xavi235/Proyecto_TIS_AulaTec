<?php

use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\AmbienteHorarioController;
use App\Http\Controllers\HorarioController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/home', [AmbienteController::class, 'index'])->name('home')->middleware('auth');

Route::resource('Ambiente', AmbienteController::class)->middleware('auth');

Route::resource('Horario', AmbienteHorarioController::class)->middleware('auth');

Route::get('/get-ambientes', [AmbienteController::class, 'getAmbientes'])->name('get.ambientes')->middleware('auth');

Route::get('/ambiente_horarios', [AmbienteHorarioController::class, 'index'])->name('ambiente_horarios.index')->middleware('auth');

Route::get('/Horario/create', [HorarioController::class, 'create'])->name('Horario.create')->middleware('auth');

Route::post('/ambiente_horarios', [AmbienteHorarioController::class, 'store'])->name('ambiente_horarios.store')->middleware('auth');

Route::get('/horario/create', [HorarioController::class, 'create'])->name('Horario.create')->middleware('auth');

//redireccion ala pagina de docente
Route::view('/docente', 'docente')->name('docente');
