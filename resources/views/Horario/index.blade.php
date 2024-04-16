@extends('adminlte::page')

@section('title', 'Listado de ambiente_horarios')

@section('content_header')
    <h1>Listado de Ambiente y Horarios</h1>
@stop

@section('content')
    <a href="{{ route('Horario.create') }}" class="btn btn-primary mb-3">CREAR</a>
    <table class="table table-striped table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Departamento</th>
                <th>Ambiente</th>
                <th>Ubicacion</th>
                <th>Horario Reserva</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ambienteHorarios as $ambienteHorario)
                <tr>
                    <td>{{ $ambienteHorario->id }}</td>
                    <td>{{ $ambienteHorario->ambiente->departamento }}</td>
                    <td>{{ $ambienteHorario->ambiente->tipoDeAmbiente }}</td>
                    <td>{{ $ambienteHorario->ambiente->ubicacion->nombre }}</td>
                    <td>{{ $ambienteHorario->horario->horaini }}</td>
                    <td>{{ $ambienteHorario->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
