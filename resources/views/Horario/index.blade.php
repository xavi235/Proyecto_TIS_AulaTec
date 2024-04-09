@extends('adminlte::page')

@section('title', 'Listado de horarios')

@section('content_header')
    <h1>Listado de horarios</h1>
@stop

@section('content')
    <a href="{{ route('Horario.create') }}" class="btn btn-primary mb-3">CREAR</a>
    <table id="horario" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Hora inicio</th>
                <th scope="col">Hora fin</th>
                <th scope="col">Ambiente</th>
                <th scope="col">Estado</th>
                <!-- <th scope="col">Acciones</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $horario)
                <tr>
                    <td>{{ $horario->id }}</td>
                    <td>{{ $horario->horaini }}</td>
                    <td>{{ $horario->horafin }}</td>
                    <td>
                        @if ($horario->ambiente)
                            {{ $horario->ambiente->departamento }}
                        @else
                            Sin ambiente asignado
                        @endif
                    </td>
                    <td>
                        @if ($horario->estado)
                            {{ $horario->estado }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function () {
            $('#horario').DataTable({
        "language": {
            "search": "Buscador",
            "lengthMenu": "",
            "info" : ""
        }
    });
            
        });
    </script>
    
@stop
