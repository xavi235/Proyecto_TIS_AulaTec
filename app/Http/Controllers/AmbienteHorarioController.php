<?php

namespace App\Http\Controllers;

use App\Models\ambiente_horario;
use App\Models\AmbienteHorario;
use Illuminate\Http\Request;

class AmbienteHorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambienteHorarios = AmbienteHorario::all();
        return view('Horario.index', compact('ambienteHorarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'estado' => 'required',
        'horario' => 'required|array', // Cambiado a 'array'
        'ambiente' => 'required',
        'dia' => 'required',
    ]);

    // Obtener los horarios seleccionados
    $horariosSeleccionados = $request->input('horario');

    // Verificar si ya existe una entrada para los mismos horarios seleccionados
    $existe = AmbienteHorario::whereIn('id_horario', $horariosSeleccionados)
        ->where('id_ambiente', $request->ambiente)
        ->where('estado', 'Ocupado')
        ->where('dia', $request->dia)
        ->exists();

    if (!$existe) {
        // Iterar sobre los horarios seleccionados
        foreach ($horariosSeleccionados as $horario) {
            // Crear una nueva instancia del modelo Ambiente_horario
            $ambienteHorario = new AmbienteHorario();

            // Asignar los valores del formulario a los campos del modelo
            $ambienteHorario->estado = $request->estado;
            $ambienteHorario->id_horario = $horario;
            $ambienteHorario->id_ambiente = $request->ambiente;
            $ambienteHorario->dia = $request->dia;

            // Guardar el nuevo ambiente horario en la base de datos
            $ambienteHorario->save();
        }

        // Retornar una respuesta de éxito
        return response()->json(['success' => true]);
    } else {
        // Retornar una respuesta de error si ya existe un horario registrado
        return response()->json(['error' => 'Ya existe un horario registrado para el mismo día y ambiente.'], 422);
    }
}




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ambiente_horario  $ambiente_horario
     * @return \Illuminate\Http\Response
     */
    public function show(AmbienteHorario $ambiente_horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ambiente_horario  $ambiente_horario
     * @return \Illuminate\Http\Response
     */
    public function edit(AmbienteHorario $ambiente_horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ambiente_horario  $ambiente_horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AmbienteHorario $ambiente_horario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ambiente_horario  $ambiente_horario
     * @return \Illuminate\Http\Response
     */
    public function destroy(AmbienteHorario $ambiente_horario)
    {
        //

    }
}
