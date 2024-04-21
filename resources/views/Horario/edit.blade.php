@extends('adminlte::page')

@section('title', 'CRUD HORARIOS')

@section('content_header')
    <h1>Editar Horas y Ambientes</h1>
@stop

@section('content')
<form action="/Horario/{{$Horario->id}}" method="POST" id="horarioForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" name="estado" class="form-control" readonly value="Ocupado">
                    <!--<select id="estado" name="estado" class="form-control" tabindex="1">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>-->
                </div>
                <div class="mb-3">
                    <label for="horario" class="form-label">Dia</label>
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
                    <select id="horario" name="horario[]" class="form-control" tabindex="2" multiple>
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
            <button type="submit" class="btn btn-primary" tabindex="5">Registrar</button>
        </div>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
