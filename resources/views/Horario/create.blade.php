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
                    <select id="estado" name="estado" class="form-control" tabindex="1">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="horario" class="form-label">Horario</label>
                    <select id="horario" name="horario" class="form-control" tabindex="2">
                        @foreach($horarios as $horario)
                            <option value="{{ $horario->id }}">{{ $horario->horaini }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ambiente" class="form-label">Ambiente</label>
                    <select id="ambiente" name="ambiente" class="form-control" tabindex="3">
                        @foreach($ambientes as $ambiente)
                            <option value="{{ $ambiente->id }}">{{ $ambiente->tipoDeAmbiente }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <a href="{{ route('Ambiente.index') }}" class="btn btn-secondary" tabindex="4">Cancelar</a>
            <button type="submit" class="btn btn-primary" tabindex="5" id="guardarBtn" disabled>Registrar</button>
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
                var estado = $('#estado').val();
                var horario = $('#horario').val();
                var ambiente = $('#ambiente').val();

                if (estado && horario && ambiente) {
                    $('#guardarBtn').prop('disabled', false);
                } else {
                    $('#guardarBtn').prop('disabled', true);
                }
            }

            $('#estado, #horario, #ambiente').change(function() {
                checkFormValidity();
            });

            $('#horarioForm').submit(function(e) {
                e.preventDefault(); // Evitar envío normal del formulario

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        // Aquí puedes agregar la lógica para mostrar el mensaje de éxito
                        Swal.fire({
                            title: 'Registro exitoso!',
                            text: 'El horario ha sido registrado correctamente.',
                            icon: 'success',
                            timer: 2000, // Duración en milisegundos (3 segundos)
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then((result) => {
                            // Redirigir al index de horarios al cerrar la alerta
                            window.location.href = "{{ route('Horario.index') }}";
                        });
                        // Limpiar el formulario después del registro exitoso
                        $('#horarioForm')[0].reset();
                        $('#guardarBtn').prop('disabled', true);
                    },
                    error: function(xhr, status, error) {
                        // Aquí puedes manejar errores si el registro falla
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@stop
