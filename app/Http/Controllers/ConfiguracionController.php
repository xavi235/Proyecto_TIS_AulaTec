<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracion;

class ConfiguracionController extends Controller
{

public function index()
{
    $configuracion = Configuracion::first();
    return view('configuracion.index', compact('configuracion'));
}

public function guardarConfiguracion(Request $request)
{
    $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'cantidad_periodos' => 'required|integer|min:1|max:10',
    ]);

    try {
        $configuracion = Configuracion::first();
        if (!$configuracion) {
            $configuracion = new Configuracion();
        }
        $configuracion->fecha_inicio = $request->fecha_inicio;
        $configuracion->fecha_fin = $request->fecha_fin;
        $configuracion->periodos = $request->cantidad_periodos;
        $configuracion->save();

        return redirect()->back()->with('success', 'Actualización exitosa');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['database' => 'Error al guardar la configuración en la base de datos.']);
    }
}


}
