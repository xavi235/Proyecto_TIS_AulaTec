@extends('adminlte::page')

@section('title', 'CRUD HORARIOS')

@section('content_header')
    <h1>Registro de horarios</h1>
@stop

@section('content')
    <form action="/Horario" method="POST" id="horarioForm">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="horaini" class="form-label">Hora inicio</label>
                    <select id="horaini" name="horaini" class="form-select form-control" tabindex="1">
                        @for ($hour = 6; $hour <= 8; $hour++)
                            @php
                                $selected = ($hour == 6) ? 'selected' : '';
                            @endphp
                            <option value="{{ str_pad($hour, 2, "0", STR_PAD_LEFT) }}:45" {{ $selected }}>
                                {{ str_pad($hour, 2, "0", STR_PAD_LEFT) }}:45
                            </option>
                            <option value="{{ str_pad($hour, 2, "0", STR_PAD_LEFT) }}:15">
                                {{ str_pad($hour, 2, "0", STR_PAD_LEFT) }}:15
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="horafin" class="form-label">Hora fin</label>
                    <select id="horafin" name="horafin" class="form-select form-control" tabindex="2">
                        @for ($hour = 6; $hour <= 8; $hour++)
                            @php
                                $selected = ($hour == 8) ? 'selected' : '';
                            @endphp
                            <option value="{{ str_pad($hour, 2, "0", STR_PAD_LEFT) }}:45" {{ $selected }}>
                                {{ str_pad($hour, 2, "0", STR_PAD_LEFT) }}:45
                            </option>
                            <option value="{{ str_pad($hour, 2, "0", STR_PAD_LEFT) }}:15">
                                {{ str_pad($hour, 2, "0", STR_PAD_LEFT) }}:15
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="ambiente" class="form-label">Ambiente</label>
                    <select id="ambiente" name="ambiente" class="form-control" tabindex="3">
                        <option value="">Selecciona un ambiente</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select id="estado" name="estado" class="form-control" tabindex="4">
                        <option value="" selected disabled>Selecciona un estado</option>
                        <option value="Disponible">Disponible</option>
                        <option value="No Disponible">No Disponible</option>
                    </select>
                </div>
                <!-- Campo oculto para almacenar el valor del estado seleccionado -->
                <input type="hidden" id="estado_hidden" name="estado_hidden">
            </div>
        </div>
        <div class="mb-3">
            <a href="/Ambiente" class="btn btn-secondary" tabindex="5">Cancelar</a>
            <button type="submit" class="btn btn-primary" id="guardarBtn" tabindex="6" disabled>Guardar</button>
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
            $.ajax({
                url: "{{ route('get.ambientes') }}",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var options = '<option value="">Selecciona un ambiente</option>';
                    $.each(data, function(key, ambiente) {
                        options += '<option value="' + ambiente.id + '">' + ambiente.departamento + '</option>';
                    });
                    $('#ambiente').html(options);
                }
            });

            // Capturar el cambio en el campo de estado y asignarlo al campo oculto
            $('#estado').change(function() {
                $('#estado_hidden').val($(this).val());
                checkFormValidity(); // Verificar validez del formulario al cambiar el estado
            });

            // Verificar validez del formulario al cargar la página
            checkFormValidity();

            function checkFormValidity() {
                var horaini = $('#horaini').val();
                var horafin = $('#horafin').val();
                var ambiente = $('#ambiente').val();
                var estado = $('#estado').val();

                if (horaini && horafin && ambiente && estado) {
                    $('#guardarBtn').prop('disabled', false);
                } else {
                    $('#guardarBtn').prop('disabled', true);
                }
            }
        });
    </script>
@stop
