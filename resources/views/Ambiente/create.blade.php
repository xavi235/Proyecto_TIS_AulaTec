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
                    <input id="departamento" name="departamento" type="text" class="form-control" tabindex="1" maxlength="30">
                    <div id="departamentoError" class="text-danger"></div>
                </div>

                <div class="mb-3">
                    <label for="capacidad" class="form-label">Capacidad</label>
                    <input id="capacidad" name="capacidad" type="text" class="form-control" tabindex="2">
                    <div id="capacidadError" class="text-danger"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de ambiente</label>
                    <input id="tipo" name="tipo" type="text" class="form-control" tabindex="3" maxlength="30">
                    <div id="tipoError" class="text-danger"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            
            checkFormValidity();

            
            function checkFormValidity() {
                var departamento = $('#departamento').val();
                var capacidad = $('#capacidad').val();
                var tipo = $('#tipo').val();

                
                if (isNaN(capacidad.trim()) || capacidad.trim() < 25 || capacidad.trim() > 120) {
                    $('#capacidadError').text('La capacidad debe estar entre 25 y 120.');
                    $('#guardarBtn').prop('disabled', true);
                } else {
                    $('#capacidadError').text('');
                    $('#guardarBtn').prop('disabled', false);
                }

                // Verificar si la capacidad es un número
                if (!$.isNumeric(capacidad.trim()) && capacidad.trim() !== '') {
                    $('#capacidadError').text('Solo se permiten caracteres numéricos.');
                    $('#guardarBtn').prop('disabled', true);
                } else {
                    $('#capacidadError').text('');
                }
                
                var regex = /^[a-zA-Z0-9\s]*$/u; // Expresión regular para letras, números y espacios

                if (!regex.test(departamento.trim()) && departamento.trim() !== '') {
                    $('#departamentoError').text('El campo departamento solo debe contener letras, números y espacios.');
                    $('#guardarBtn').prop('disabled', true);
                } else {
                    $('#departamentoError').text('');
                    if (departamento.trim().length < 4 || departamento.trim().length > 30) {
                        $('#guardarBtn').prop('disabled', true);
                    }
                }

                if (!regex.test(tipo.trim()) && tipo.trim() !== '') {
                    $('#tipoError').text('El campo tipo solo debe contener letras, números y espacios.');
                    $('#guardarBtn').prop('disabled', true);
                } else {
                    $('#tipoError').text('');
                    if (tipo.trim().length < 4 || tipo.trim().length > 30) {
                        $('#guardarBtn').prop('disabled', true);
                    }
                }
            }

           
            $('#departamento, #capacidad, #tipo').change(function() {
                checkFormValidity();
            });

            
            $('#ambienteForm').submit(function() {
                checkFormValidity();
                if ($('#guardarBtn').prop('disabled')) {
                    return false;
                }
                
                
                Swal.fire(
                    'Registro exitoso!',
                    'El ambiente ha sido registrado correctamente.',
                    'success'
                );
            });
        });
    </script>
@stop
