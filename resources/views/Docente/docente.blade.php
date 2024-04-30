@extends('adminlte::page')

@section('title', 'CRUD')

@section('content_header')
    <h1>Listado de ambiente horarios</h1>
@stop

@section('content')
    <a href="{{ route('solicitud_reserva') }}" class="btn btn-primary">Solicitud de Reserva</a>
    <!-- Agrega el botón con el enlace a la nueva ruta -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
            </tr>
        </thead>
        
    </table>
@stop
