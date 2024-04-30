<?php

namespace App\Http\Controllers;

use App\Models\ambiente_horario;
use App\Models\AmbienteHorario;
use App\Models\dia;
use App\Models\EstadoHorario;
use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Ambiente;

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
        $departamentos = Ambiente::all()->pluck('departamento')->unique();
        $ambientes = Ambiente::all();
        $horarios = Horario::all();
        $dias = dia::all();
        return view('Horario.index', compact('ambienteHorarios','ambientes','departamentos','horarios','dias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    // Recuperar los datos del seeder para los estados
    $estados = EstadoHorario::all();
    $dias = dia::all();
    $horarios = Horario::all();
    return view('Horario.create', compact('estados', 'dias', 'horarios'));
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'id_ambiente' => 'required',
            'id_horario' => 'required',
            'id_dia' => 'required',
            'id_estado_horario' => 'required',
        ]);
    
        // Crear una nueva instancia del modelo AmbienteHorario
        $ambienteHorario = new AmbienteHorario();
    
        // Asignar los valores del formulario a los campos del modelo
        $ambienteHorario->id_ambiente = $request->id_ambiente;
        $ambienteHorario->id_horario = $request->id_horario;
        $ambienteHorario->id_dia = $request->id_dia;
        $ambienteHorario->id_estado_horario = $request->id_estado_horario;
    
        // Guardar el nuevo registro en la base de datos
        $ambienteHorario->save();
        session()->flash('success', 'El ambiente ha sido registrado correctamente.');
        // Redireccionar a una vista de éxito o cualquier otra acción deseada
        return redirect()->route('Horario.index');
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
