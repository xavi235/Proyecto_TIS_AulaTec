<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracion;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuracion = Configuracion::first();
        return view('Configuracion.index', compact('configuracion'));
    }

    public function guardarConfiguracion(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'cantidad_periodos' => 'required|integer|min:1|max:10',
            'cantidad_periodos_laboratorio' => 'required|integer|min:1|max:10',
        ]);

        $configuracion = Configuracion::first();

        if (!$configuracion) {
            $configuracion = new Configuracion();
        }
        $configuracion->fecha_inicio = $request->fecha_inicio;
        $configuracion->fecha_fin = $request->fecha_fin;
        $configuracion->periodos = $request->cantidad_periodos;
        $configuracion->periodosLaboratorio = $request->cantidad_periodos_laboratorio;
        $configuracion->save();

        return redirect()->back()->with('success', 'Configuración guardada exitosamente');
    }
}
