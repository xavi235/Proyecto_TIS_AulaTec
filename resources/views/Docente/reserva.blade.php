@extends('adminlte::page')

@section('content_header')
    <h1>Solicitud de Reserva</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('solicitud_reserva') }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <div class="col">
                        <label for="usuario" class="form-label">Usuario</label>
                        @if(Auth::check() && Auth::user()->name)
                            <input type="text" class="form-control" id="usuario" name="usuario" value="{{ Auth::user()->name }}" readonly>
                        @else
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario" readonly>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="materia" class="form-label">Materias</label>
                        <select id="materia" name="materia" class="form-control" tabindex="4">
                            <option value="">Seleccione una Materia</option>
                            @foreach($materias as $materia)
                                <option value="{{ $materia }}">{{ $materia }}</option>
                            @endforeach
                        </select>
                        <div id="materiaError" class="text-danger"></div>
                    </div>
                    <div class="col">
                        <label for="grupo" class="form-label">Grupos</label>
                        <select id="grupo" name="grupo" class="form-control" tabindex="4">
                            <option value="">Seleccione un grupo</option>
                        </select>
                        <div id="grupoError" class="text-danger"></div>
                    </div>
                </div>
                <!-- Resto del formulario -->
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
@stop

@push('js')
    <script>
       $(document).ready(function() {
    // Cuando se cambia la selección de materia
    $('#materia').change(function() {
        var materiaId = $(this).val();
        if (materiaId) {
            // Realizar una solicitud AJAX para obtener los grupos de la materia seleccionada
            $.ajax({
                url: '{{ route("getGrupos") }}',
                type: 'GET',
                data: {
                    id_materia: materiaId
                },
                success: function(response) {
                    // Limpiar opciones anteriores
                    $('#grupo').empty();
                    // Agregar nuevas opciones
                    $.each(response, function(key, value) {
                        $('#grupo').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            // Si no se selecciona ninguna materia, vaciar el campo de grupo
            $('#grupo').empty();
        }
    });
});

    </script>
@endpush
