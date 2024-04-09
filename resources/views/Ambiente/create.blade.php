@extends('adminlte::page')

@section('title', 'CRUD AMBIENTES')

@section('content_header')
    <h1>Registro de ambientes</h1>
@stop

@section('content')
    <form action="/Ambiente" method="POST" id="ambienteForm">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="departamento" class="form-label">Departamento</label>
                    <input id="departamento" name="departamento" type="text" class="form-control" tabindex="1">
                </div>

                <div class="mb-3">
                    <label for="capacidad" class="form-label">Capacidad</label>
                    <input id="capacidad" name="capacidad" type="text" class="form-control" tabindex="2">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de ambiente</label>
                    <input id="tipo" name="tipo" type="text" class="form-control" tabindex="3">
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <a href="/Ambiente" class="btn btn-secondary" tabindex="4">Cancelar</a>
            <button type="submit" class="btn btn-primary" id="guardarBtn" tabindex="5" disabled>Guardar</button>
        </div>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Verificar validez del formulario al cargar la página
            checkFormValidity();

            // Función para verificar validez del formulario
            function checkFormValidity() {
                var departamento = $('#departamento').val();
                var capacidad = $('#capacidad').val();
                var tipo = $('#tipo').val();

                if (departamento && capacidad && tipo) {
                    $('#guardarBtn').prop('disabled', false);
                } else {
                    $('#guardarBtn').prop('disabled', true);
                }
            }

            // Verificar validez del formulario al cambiar los valores de los campos
            $('#departamento, #capacidad, #tipo').change(function() {
                checkFormValidity();
            });

            // Verificar validez del formulario al enviar el formulario
            $('#ambienteForm').submit(function() {
                checkFormValidity();
            });
        });
    </script>
@stop
