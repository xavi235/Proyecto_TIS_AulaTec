<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
<div class="container-fluid">
    <div class="container">
        <h2>Filtros</h2>
        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
            <div class="col">
                <div class="btn-group-vertical dropright" style="width: 100%;">
                    <button type="button" class="btn btn-primary dropdown-toggle btn-block" data-toggle="dropdown">
                        <i class="bi-building"> Departamentos </i> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" id="departamento_filter">
                        <li data-val="">
                            <span class="dropdown-item"><i class="bi-building">Departamentos</i></span>
                        </li>
                        @foreach($departamentos as $departamento)
                        <li data-val="{{ $departamento }}">
                            <span class="dropdown-item"><i class="bi-building">{{ $departamento }}</i></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="btn-group-vertical dropright" style="width: 100%;">
                    <button type="button" class="btn btn-outline-success dropdown-toggle btn-block"
                        data-toggle="dropdown">
                        <i class="bi-house">Todas las Aulas </i><span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" id="aula_filter">
                        <li data-val="">
                            <span class="dropdown-item"><i class="bi-house">Todas las Aulas</i></span>
                        </li>
                        @foreach($ambientes as $ambiente)
                        <li data-val="{{ $ambiente->tipoDeAmbiente }}">
                            <span class="dropdown-item"><i class="bi-house">{{ $ambiente->tipoDeAmbiente }}</i></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="btn-group-vertical dropright" style="width: 100%;">
                    <button type="button" class="btn btn-outline-info dropdown-toggle btn-block" data-toggle="dropdown">
                        <i class="bi-calendar">Todas los Dias</i> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" id="dias_filter">
                        <li data-val="">
                            <span class="dropdown-item"><i class="bi-calendar">Todas los Dias</i></span>
                        </li>
                        @foreach($dias as $dia)
                        <li data-val="{{ $dia }}">
                            <span class="dropdown-item"><i class="bi-calendar">{{ $dia }}</i></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="btn-group-vertical dropright" style="width: 100%;">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle btn-block"
                        data-toggle="dropdown">
                        <i class="bi-clock">Todos los Horarios</i> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" id="horario_filter">
                        <li data-val="">
                            <span class="dropdown-item"><i class="bi-clock">Todos los Horarios</i></span>
                        </li>
                        @foreach($horarios as $horario)
                        <li data-val="{{ $horario->horaini }}">
                            <span class="dropdown-item"><i class="bi-clock">{{ $horario->horaini }}</i></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div style="overflow-x: auto;">
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
                            <a class="btn btn-info"><i class="bi-pencil-fill"></i></a>
                            <button class="btn btn-danger"><i class="bi-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
var table;
$(document).ready(function() {
    table = $('#ambienteHorariosTable').DataTable({
        "language": {
            "search": '<span class="fa fa-search"></span>', // Cambiar el texto por un icono
            "lengthMenu": "",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página PAGE de PAGES",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrando de un total de MAX registros)",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        },
        "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
    });

    // Controladores de eventos para los filtros
    $('#departamento_filter .dropdown-item').on('click', function() {
        var selectedValue = $(this).parent().attr('data-val');
        var selectedText = $(this).text();
        $(this).closest('.btn-group-vertical').find('.btn-primary').html('<i class="bi-building">' +
            selectedText + ' </i><span class="caret"></span>');
        table.column(1).search(selectedValue).draw();
    });

    $('#aula_filter .dropdown-item').on('click', function() {
        var selectedValue = $(this).parent().attr('data-val');
        var selectedText = $(this).text();
        $(this).closest('.btn-group-vertical').find('.btn-outline-success').html(
            '<i class="bi-house">' + selectedText + ' </i><span class="caret"></span>');
        table.column(2).search(selectedValue).draw();
    });

    $('#dias_filter .dropdown-item').on('click', function() {
        var selectedValue = $(this).parent().attr('data-val');
        var selectedText = $(this).text();
        $(this).closest('.btn-group-vertical').find('.btn-outline-info').html(
            '<i class="bi-calendar">' + selectedText + ' </i><span class="caret"></span>');
        table.column(3).search(selectedValue).draw();
    });

    $('#horario_filter .dropdown-item').on('click', function() {
        var selectedValue = $(this).parent().attr('data-val');
        var selectedText = $(this).text();
        $(this).closest('.btn-group-vertical').find('.btn-outline-primary').html(
            '<i class="bi-clock">' + selectedText + ' <span class="caret"></span>');
        table.column(4).search(selectedValue).draw();
    });
});
</script>
@stop