@extends('adminlte::page')

@section('title', 'CRUD')

@section('content_header')
<div class="text-center mb-4">
    <h1 class="welcome-text">BIENVENIDO</h1>
</div>
@if(isset($configuracion))
<div class="alert alert-info text-center rules-message">
    <p>Las reglas para enviar una solicitud son las siguientes: Enviar Solicitudes antes de las fechas indicadas ,
        Solo esta permitido selecionar un Tipo de Ambiente y la cantidad de periodos para el tipo de Ambiente Selecionado .</p>
</div>
<div class="row mt-5">
    <div class="col-md-6">
        <p><span class="reception-date-title">Inicio de Recepción de Solicitudes:</span> <span class="reception-date">{{ $configuracion->fecha_inicio->format('d') }} de {{ $meses[$configuracion->fecha_inicio->format('n') - 1] }} de {{ $configuracion->fecha_inicio->format('Y') }}</span></p>
        <p class="reception-date-title">Cantidad de Periodos a selecionar Aula o Auditorio: <span class="reception-date" id="periodosCantidad">{{ $configuracion->periodos }}</span></p>
        
    </div>
    <div class="col-md-6">
        <p><span class="reception-date-title">Fin de Recepción de Solicitudes:</span> <span class="reception-date">{{ $configuracion->fecha_fin->format('d') }} de {{ $meses[$configuracion->fecha_fin->format('n') - 1] }} de {{ $configuracion->fecha_fin->format('Y') }}</span></p>
        <p class="reception-date-title">Cantidad de Periodos a selecionar Laboratorio: <span class="reception-date" id="periodosCantidad">{{ $configuracion->periodosLaboratorio }}</span></p>
    </div>
</div>

<hr>
<div id="multiItemCarousel" class="carousel slide carousel-slide" data-bs-ride="carousel" data-bs-interval="6000">
    <div class="carousel-inner">
        <!-- Las imágenes del carrusel se cargarán aquí mediante JavaScript -->
    </div>
</div>
@else
<div class="alert alert-warning text-center">
    <p>No se encontró información de configuración.</p>
</div>
@endif
@stop

@section('content')
@if(isset($reserva) && $estado !== 'confirmado')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Detalles de la Reserva</h4>
            </div>
            <div class="card-body">
                <p><strong>Solicitante:</strong> {{ $reserva['docente'] }}</p>
                <p><strong>Número de reserva:</strong> {{ $reserva['id'] }}</p>
                <p><strong>Fecha y hora:</strong> {{ $reserva['fecha_reserva']->format('d/m/Y H:i') }}</p>
                <p><strong>Grupo:</strong> {{ $reserva['grupo'] }}</p>
                <p><strong>Materia:</strong> {{ $reserva['materia'] }}</p>
                <p><strong>Motivo:</strong> {{ $reserva['acontecimiento'] }}</p>
                <p><strong>Horario:</strong> {{ $reserva['horario'] }}</p>
                <p><strong>Tipo Ambiente:</strong> {{ $reserva['tipo_ambiente'] }}</p>
                <p><strong>Ambientes Disponibles:</strong></p>
                <ul class="list-group mb-3">
                    @foreach($ambientes as $ambiente)
                    <li class="list-group-item">
                        <input type="checkbox" name="ambientes[]" value="{{ $ambiente }}" checked> {{ $ambiente }}
                    </li>
                    @endforeach
                </ul>
                <div class="card-footer text-center">
                    <form id="reserva-form" action="{{ route('confirmar-solicitud', ['id' => $reserva['id'], 'action' => 'default']) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-danger btn-lg" onclick="submitForm('rechazar')">Rechazar</button>
                        <button type="button" class="btn btn-success btn-lg" onclick="submitForm('confirmar')">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function submitForm(action) {
    const form = document.getElementById('reserva-form');
    form.action = form.action.replace('default', action);
    form.submit();
}
</script>
@else

@endif
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('estilos/Docente.css') }}">
@stop

@section('js')
<!-- Incluye Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb2SAa4d6z44s20z2T94HfQV4fjtK4L6X7P0rRX13DeE6l5Ff" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha384-cu9VcVzRyOnJOg1LOhZR9zrbfl9iUV+j0Eptp5iDoIwlq5oD+rluYVhR+8s2YOhM" crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const images = @json($images);
    const itemsPerSlide = 3;
    let currentIndex = 0;

    function loadCarouselImages() {
        const carouselInner = document.querySelector('#multiItemCarousel .carousel-inner');
        carouselInner.innerHTML = '';

        const chunk = images.slice(currentIndex, currentIndex + itemsPerSlide);
        const itemDiv = document.createElement('div');
        itemDiv.className = 'carousel-item active';
        const rowDiv = document.createElement('div');
        rowDiv.className = 'row';

        chunk.forEach(image => {
            const colDiv = document.createElement('div');
            colDiv.className = 'col-md-4';
            colDiv.innerHTML = `
                <div class="d-flex justify-content-center">
                    <img src="${image.src}" class="d-block w-100 img-fluid" alt="${image.alt}">
                </div>
                <div class="text-center mt-2">
                    <h5>${image.caption}</h5>
                </div>
            `;
            rowDiv.appendChild(colDiv);
        });

        itemDiv.appendChild(rowDiv);
        carouselInner.appendChild(itemDiv);
    }

    loadCarouselImages();

    setInterval(function() {
        currentIndex = (currentIndex + itemsPerSlide) % images.length;
        loadCarouselImages();
    }, 6000);
    
});
</script>

<!-- Pie de página -->
<footer class="text-center" style="background-color: rgb(112, 127, 240); color: white; padding: 1px;">
    <p style="font-size: 15px;">Copyright © 2024 DevGenius. Todos los derechos son propiedad de DevGenius.</p>
</footer>
@stop
