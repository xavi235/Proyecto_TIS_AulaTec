@extends('adminlte::page')

@section('title', 'Listado de ambiente_horarios')

@section('content_header')
    <h1>Listado de ambiente horarios</h1>
@stop

@section('content')
    <a href="{{ route('Horario.create') }}" class="btn btn-primary mb-3">CREAR</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif
    <table id="ambienteHorariosTable" class="table table-striped table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Departamento</th>
                <th>Ambiente</th>
                <th>Día</th>
                <th>Horario Reserva</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ambienteHorarios as $ambienteHorario)
                <tr>
                    <td>{{ $ambienteHorario->id }}</td>
                    <td>{{ $ambienteHorario->ambiente->departamento }}</td>
                    <td>{{ $ambienteHorario->ambiente->tipoDeAmbiente }}</td>
                    <td>{{ $ambienteHorario->dia }}</td>
                    <td>{{ $ambienteHorario->horario->horaini }}</td>
                    <td>{{ $ambienteHorario->estado }}</td>
                    <td>
                        <a class="btn btn-info">Editar</a>
                        <button class="btn btn-danger">Borrar</button>
                    </td> 
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#ambienteHorariosTable').DataTable({
                "language": {
                    "search": '<span class="fa fa-search"></span>', // Cambiar el texto por un icono
                    "lengthMenu": "",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrando de un total de _MAX_ registros)",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }
                },
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>', // Cambiar el diseño del DOM
            });
        });
    </script>
@stop