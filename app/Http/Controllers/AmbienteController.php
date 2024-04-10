<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambiente;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambientes = Ambiente::all();
        return view('Ambiente.index')->with('ambientes',$ambientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Ambiente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'departamento' => 'required|string|regex:/^[a-zA-Z0-9\s]+$/u',
            'capacidad' => 'required|integer',
            'tipo' => 'required|string|regex:/^[a-zA-Z0-9\s]+$/u',
        ], [
            'departamento.regex' => 'Solo se permiten caracteres alfanuméricos.',
            'tipo.regex' => 'Solo se permiten caracteres alfanuméricos.',
            'capacidad.numeric_only' => 'El campo capacidad solo acepta valores numéricos.',
        ]);

        $ambiente = new Ambiente();
        $ambiente->departamento = $validatedData['departamento'];
        $ambiente->capacidad = $validatedData['capacidad'];
        $ambiente->TipoDeAmbiente = $validatedData['tipo'];

        $ambiente->save();

        return redirect('/Ambiente');
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
