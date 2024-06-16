@extends('adminlte::page')

@section('title', 'CRUD')

@section('content_header')
<div class="text-center mb-4">
    <h1 class="welcome-text">INFORMACION SOBRE LAS RESERVAS</h1>
</div>
@if(isset($configuracion))
<div class="row mt-5">
    <div class="col-md-6">
        <p><span class="reception-date-title">Inicio de Recepción de Solicitudes:</span> <span class="reception-date">{{ $configuracion->fecha_inicio->format('d') }} de {{ $meses[$configuracion->fecha_inicio->format('n') - 1] }} de {{ $configuracion->fecha_inicio->format('Y') }}</span></p>
        <p class="reception-date-title">Cantidad de Periodos a seleccionar Aula o Auditorio: <span class="reception-date" id="periodosCantidad">{{ $configuracion->periodos }}</span></p>
    </div>
    <div class="col-md-6">
        <p><span class="reception-date-title">Fin de Recepción de Solicitudes:</span> <span class="reception-date">{{ $configuracion->fecha_fin->format('d') }} de {{ $meses[$configuracion->fecha_fin->format('n') - 1] }} de {{ $configuracion->fecha_fin->format('Y') }}</span></p>
        <p class="reception-date-title">Cantidad de Periodos a seleccionar Laboratorio: <span class="reception-date" id="periodosCantidad">{{ $configuracion->periodosLaboratorio }}</span></p>
    </div>
</div>
<div class="alert alert-info text-center rules-message">
    <p>Las reglas para realizar una solicitud son las siguientes: estar en el rango de fechas para 
        poder realizar el envío de la solicitud, solo son permitidos las selecciones de los periodos de los tipos de ambientes que se muestran 
        
        <p></p>
        ¡Gracias por elegir AulaTec para tus reservas de ambientes en la Universidad Mayor de San Simón!      
    </p>
</div>
@else
<div class="row mt-5">
    <p>No hay datos de configuración disponibles.</p>
</div>
@endif
@endsection

@section('footer')
<footer class="text-center" style="background-color: rgb(112, 127, 240); color: white; padding: 1px;">
    <p style="font-size: 15px;">Copyright © 2024 DevGenius. Todos los derechos son propiedad de DevGenius.</p>
</footer>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('estilos/Docente.css') }}">
@stop
