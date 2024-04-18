@extends('adminlte::page')

@section('title', 'CRUD')

@section('content_header')
    <h1>Listado de ambientes</h1>
@stop

@section('content')
    @if(Auth::check() && Auth::user()->id_rol === 1)
        <a href="Ambiente/create" class="btn btn-primary mb-3">CREAR</a>
        <table id="ambiente" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%"> 
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Capacidad</th>
                    <th scope="col">Tipo de ambiente</th>
                    <!-- <th scope="col">Estado</th> -->
                    <!-- <th scope="col">Acciones</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($ambientes as $ambiente)
                    <tr>
                        <td>{{$ambiente->id}}</td>
                        <td>{{$ambiente->departamento}}</td>
                        <td>{{$ambiente->capacidad}}</td>
                        <td>{{$ambiente->tipoDeAmbiente}}</td>
                        <!-- <td>{{$ambiente->estado}}</td> -->
                        <!-- <td>
                            <a class = "btn btn-info">Editar</a>
                            <button class = "btn btn-danger">Borrar</button>
                        </td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop

@section('css')
    <link href= "https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css" rel="stylesheet">
@stop

@section('js')
    <script src ="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src ="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src ="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>

    <script>    
        $(document).ready(function() {
            $('#ambiente').DataTable({
                "language": {
                    "search": "Buscador",
                    "lengthMenu": "",
                    "info" : ""
                }
            });
        });
    </script>
@stop
