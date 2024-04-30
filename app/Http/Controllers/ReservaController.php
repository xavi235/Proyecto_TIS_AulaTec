<?php

namespace App\Http\Controllers;

use App\Models\Acontecimiento;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Reserva;
use App\Models\Usuario_Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
{
    // Acontecimientos necesarios
    $acontecimientos = Acontecimiento::all();
  
    // Nombre del usuario actualmente autenticado
    $userName = Auth::user()->name;
  
    // Consulta SQL para obtener las materias y grupos del usuario
    $result = DB::select("
        SELECT u.name AS nombre_usuario, 
               GROUP_CONCAT(DISTINCT m.nombre) AS materias,
               GROUP_CONCAT(DISTINCT g.grupo) AS grupos
        FROM usuario_materias um 
        JOIN users u ON um.id_user = u.id 
        JOIN materias m ON um.id_grupo_materia = m.id 
        JOIN grupos g ON um.id_grupo_materia = g.id 
        WHERE u.name = :userName 
        GROUP BY u.name;
    ", ['userName' => $userName]);
  
    // Verificar si se obtuvieron resultados
    if (!empty($result)) {
        $materias = explode(',', $result[0]->materias);
        $grupos = explode(',', $result[0]->grupos);
    } else {
        $materias = [];
        $grupos = [];
    }
  
    return view('Docente.reserva', compact('materias', 'acontecimientos', 'grupos'));
}
public function getGrupos(Request $request)
{
    $idMateria = $request->input('id_materia');

    // Filtrar los grupos por la materia seleccionada
    $grupos = Grupo::where('id_materia', $idMateria)->pluck('grupo', 'id');

    return response()->json($grupos);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
