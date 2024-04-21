@extends('adminlte::page')

@section('title', 'CRUD HORARIOS')

@section('content_header')
    <h1>Registro de Horas y Ambientes</h1>
@stop

@section('content')
    <form action="{{ route('Horario.store') }}" method="POST" id="horarioForm">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" name="estado" class="form-control" readonly value="Ocupado">
                </div>
                <div class="mb-3">
                    <label for="dia" class="form-label">Dia</label>
                    <select id="dia" name="dia" class="form-control" tabindex="2">
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miercoles">Miercoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sabado">Sabado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="horario" class="form-label">Horario</label>
                    <select id="horario" name="horario[]" class="form-control" tabindex="3" multiple>
                        @foreach($horarios as $horario)
                            <option value="{{ $horario->id }}">{{ $horario->horaini }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ambiente" class="form-label">Ambiente</label>
                    <select id="ambiente" name="ambiente" class="form-control" tabindex="4">
                        @foreach($ambientes as $ambiente)
                            <option value="{{ $ambiente->id }}">{{ $ambiente->tipoDeAmbiente }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <a href="{{ route('Ambiente.index') }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
            <button type="submit" class="btn btn-primary" tabindex="6">Registrar</button>
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
            $('#horarioForm').submit(function(event) {
                event.preventDefault(); // Prevenir el envío del formulario
    
                // Hacer la petición AJAX
                $.ajax({
                    url: $(this).attr('action'), // Obtener la URL del formulario
                    method: $(this).attr('method'), // Obtener el método del formulario
                    data: $(this).serialize(), // Obtener los datos del formulario
                    success: function(response) {
                        // Mostrar la alerta de éxito si la respuesta es exitosa
                        if (response.success) {
                            Swal.fire({
                                title: 'Registro exitoso!',
                                text: 'El horario y ambiente han sido registrados correctamente.',
                                icon: 'success',
                                timer: 2000, // Duración en milisegundos (2 segundos)
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then((result) => {
                                window.location.href = "/Horario";
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Mostrar el mensaje de error si la respuesta es un error de validación
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON.error,
                                icon: 'error',
                                timer: 3000, // Duración en milisegundos (3 segundos)
                                timerProgressBar: true,
                                showConfirmButton: false
                            });
                        }
                    }
                });
            });
        });
    </script>
    
@stop
