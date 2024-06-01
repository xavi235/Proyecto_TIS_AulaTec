@extends('adminlte::page')

@section('title', 'CRUD')

@section('content_header')
    <h1>Bienvenidos</h1>
@stop

@section('content')
    @if(isset($reserva))
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Detalles de la Reserva
                    </div>
                    <div class="card-body">
                        <p><strong>Solicitante:</strong> {{ $reserva['docente'] }}</p>
                        <p><strong>Número de reserva:</strong> {{ $reserva['id'] }}</p>
                        <p><strong>Fecha y hora:</strong> {{ $reserva['fecha_reserva'] }}</p>
                        <p><strong>Grupo:</strong> {{ $reserva['grupo'] }}</p>
                        <p><strong>Materia:</strong> {{ $reserva['materia'] }}</p>
                        <p><strong>Motivo:</strong> {{ $reserva['acontecimiento'] }}</p>
                        <p><strong>Horario:</strong> {{ $reserva['horario'] }}</p>
                        <p><strong>Tipo Ambiente:</strong> {{ $reserva['tipo_ambiente'] }}</p>
                        <p><strong>Ambientes Disponibles:</strong></p>
                        <form action="" method="POST">
                            @csrf
                            <ul>
                                @foreach($ambientes as $ambiente)
                                    <li>
                                        <input type="checkbox" name="ambientes[]" value="{{ $ambiente }}" checked> {{ $ambiente }}
                                    </li>
                                @endforeach
                            </ul>
                            <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <form action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">Deshacer Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>No se encontró información de la reserva.</p>
    @endif

@stop
