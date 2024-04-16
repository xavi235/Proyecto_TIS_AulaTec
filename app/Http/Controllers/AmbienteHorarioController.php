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
        'horario' => 'required', // Cambiado a 'horario' en lugar de 'horario_id'
        'ambiente' => 'required', // Cambiado a 'ambiente' en lugar de 'ambiente_id'
    ]);

    // Crear una nueva instancia del modelo Ambiente_horario
    $ambienteHorario = new AmbienteHorario();

    // Asignar los valores del formulario a los campos del modelo
    $ambienteHorario->estado = $request->estado;
    $ambienteHorario->id_horario = $request->horario; // Cambiado a 'id_horario'
    $ambienteHorario->id_ambiente = $request->ambiente; // Cambiado a 'id_ambiente'

    // Guardar el nuevo ambiente horario en la base de datos
    $ambienteHorario->save();

    // Redireccionar a una ruta después de guardar (opcional)
    return redirect()->route('ambiente_horarios.index')->with('success', 'Ambiente Horario creado correctamente');
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
