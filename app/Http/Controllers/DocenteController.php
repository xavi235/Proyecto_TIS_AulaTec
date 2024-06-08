<?php
namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DocenteController extends Controller
{
    public function index()
    {
        $configuracion = Configuracion::first();
    
        $configuracion->fecha_inicio = Carbon::parse($configuracion->fecha_inicio);
        $configuracion->fecha_fin = Carbon::parse($configuracion->fecha_fin);

        $meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        $images = [
            ['src' => 'img/edificionuevo.jpg', 'alt' => 'Información adicional 1', 'caption' => 'EDIFICIO ACADEMICO 2'],
            ['src' => 'img/edificiobiologia.jpg', 'alt' => 'Información adicional 2', 'caption' => 'EDIFICIO DE LABORATORIOS BASICOS'],
            ['src' => 'img/nuevainfraestructura.jpg', 'alt' => 'Información adicional 3', 'caption' => 'EMBATE - INCUBADORA DE EMPRESAS DE BASE TECNOLOGICA'],
            ['src' => 'img/aulanormal.jpg', 'alt' => 'Información adicional 4', 'caption' => 'AULA COMUN'],
            ['src' => 'img/laboratorio.jpg', 'alt' => 'Información adicional 4', 'caption' => 'LABORATORIO DE COMPUTO'],
            ['src' => 'img/auditorio.jpg', 'alt' => 'Información adicional 4', 'caption' => 'AUDITORIO'],
        ];

        return view('Docente.docente', compact('configuracion', 'meses', 'images'));
    }
}
