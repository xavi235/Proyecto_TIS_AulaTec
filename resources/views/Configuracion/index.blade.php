@extends('adminlte::page')

@section('title', 'Configuracion Solicitudes')

@section('content_header')
    @if(Auth::check() && Auth::user()->id_rol === 1)
        <h1>Configuracion Solicitudes</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('guardar_configuracion') }}" method="POST" id="configuracion_form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio para la reserva</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $configuracion->fecha_inicio ?? '' }}" min="{{ date('Y-m-d') }}">
                            <small class="text-muted">Ingrese la Fecha de Inicio para poder enviar una Solicitud</small>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="fecha_fin" class="form-label">Fecha de fin para la reserva</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ $configuracion->fecha_fin ?? '' }}" min="{{ date('Y-m-d') }}">
                            <div id="fecha_fin_error" class="invalid-feedback">La fecha de fin debe ser posterior a la fecha de inicio.</div>
                            <small class="text-muted">Ingrese la Fecha de Fin para poder enviar una Solicitud</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="cantidad_periodos" class="form-label">Cantidad de periodos a seleccionar para un Aula o Auditorio</label>
                            <input type="number" class="form-control" id="cantidad_periodos" name="cantidad_periodos" value="{{ $configuracion->periodos ?? '' }}" data-toggle="tooltip" data-placement="right" title="Ingrese valores entre 1 a 10">
                            <small class="text-muted">Ingrese la Cantidad de periodos que pueden seleccionar para un Aula y Auditorio</small>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="cantidad_periodos_laboratorio" class="form-label">Cantidad de periodos a seleccionar para Laboratorios</label>
                            <input type="number" class="form-control" id="cantidad_periodos_laboratorio" name="cantidad_periodos_laboratorio" value="{{ $configuracion->periodosLaboratorio ?? '' }}" data-toggle="tooltip" data-placement="right" title="Ingrese valores entre 1 a 10">
                            <small class="text-muted">Ingrese la Cantidad de periodos que pueden seleccionar para un Laboratorio</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    @endif
@stop

@section('js')
    <!-- Incluir SweetAlert2 desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Inicializar tooltips de Bootstrap -->
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        document.getElementById('configuracion_form').addEventListener('submit', function(event) {
            event.preventDefault();

            const cantidadPeriodos = document.getElementById('cantidad_periodos');
            const cantidadPeriodosValue = cantidadPeriodos.value;

            const cantidadPeriodosLaboratorio = document.getElementById('cantidad_periodos_laboratorio');
            const cantidadPeriodosLaboratorioValue = cantidadPeriodosLaboratorio.value;

            if (cantidadPeriodosValue < 1 || cantidadPeriodosValue > 10) {
                $(cantidadPeriodos).tooltip('show');
                return;
            } else {
                $(cantidadPeriodos).tooltip('hide');
            }

            if (cantidadPeriodosLaboratorioValue < 1 || cantidadPeriodosLaboratorioValue > 10) {
                $(cantidadPeriodosLaboratorio).tooltip('show');
                return;
            } else {
                $(cantidadPeriodosLaboratorio).tooltip('hide');
            }

            const fechaInicio = document.getElementById('fecha_inicio').value;
            const fechaFin = document.getElementById('fecha_fin').value;
            const fechaActual = new Date().toISOString().slice(0, 10);

            if (fechaInicio < fechaActual) {
                alert("La fecha de inicio no puede ser menor que el día actual.");
                return;
            }

            if (fechaInicio >= fechaFin) {
                $('#fecha_fin').tooltip({ title: "La fecha de fin debe ser posterior a la fecha de inicio." }).tooltip('show');
                return;
            }

            Swal.fire({
                title: '¿Está seguro que desea aplicar los cambios?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });
    </script>
@stop
