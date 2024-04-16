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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('Ambiente','App\Http\Controllers\AmbienteController');

Route::resource('Horario','App\Http\Controllers\AmbienteHorarioController');

Route::get('/get-ambientes', [AmbienteController::class, 'getAmbientes'])->name('get.ambientes');

Route::get('/ambiente_horarios', [AmbienteHorarioController::class, 'index'])->name('ambiente_horarios.index');

Route::get('/Horario/create', [HorarioController::class, 'create'])->name('Horario.create');

Route::post('/ambiente_horarios', [AmbienteHorarioController::class, 'store'])->name('ambiente_horarios.store');

Route::get('/horario/create', [HorarioController::class, 'create'])->name('Horario.create');

