<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambiente;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\Auth;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id_rol !== 1) {
            return redirect()->route('home');
        }
          $ambientes = Ambiente::all();
          return view('Ambiente.index')->with('ambientes', $ambientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ubicaciones = Ubicacion::all();
        return view('Ambiente.create', compact('ubicaciones'));
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
        'departamento' => 'required',
        'capacidad' => 'required|numeric',
        'tipo' => 'required',
        'ubicacion' => 'required',
    ]);

    $ambiente = new Ambiente();
    $ambiente->departamento = $request->input('departamento');
    $ambiente->capacidad = $request->input('capacidad');
    $ambiente->TipoDeAmbiente = $request->input('tipo');
    $ambiente->id_ubicacion = $request->input('ubicacion');

    $ambiente->save();

    return redirect('/Ambiente')->with('success', 'Ambiente creado exitosamente');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getAmbientes()
    {
    $ambientes = Ambiente::all();
    return response()->json($ambientes);
    }
    
}
