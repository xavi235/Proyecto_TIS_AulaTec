@extends('adminlte::page')

@section('title', 'CRUD')

@section('content_header')
<div class="text-center mb-4">
    <h1 class="welcome-text">BIENVENIDO</h1>
</div>
@if(isset($configuracion))
<div class="alert alert-info text-center rules-message">
    <p>En AulaTec, estamos comprometidos con facilitar tu experiencia en la reserva de ambientes en la Universidad Mayor de San Simon. Nuestra plataforma te ofrece una solución práctica y eficiente para gestionar tus reservas de manera rápida y sencilla.
        Ya sea que estés organizando clases, reuniones o eventos académicos, AulaTec está aquí para ayudarte a encontrar el espacio perfecto para tus necesidades. Con nuestra interfaz intuitiva y herramientas de reserva flexibles, puedes asegurar tu lugar de manera conveniente y sin complicaciones.
        Explora nuestras opciones de aulas, verifica disponibilidad y reserva con solo unos pocos clics. En AulaTec, estamos comprometidos a brindarte la mejor experiencia en la gestión de espacios universitarios.
        <p></p>
        ¡Gracias por elegir AulaTec para tus reservas de ambientes en la Universidad Mayor de SanSimon!      
    </p>
    <p>Si deseas obtener información para una solicitud, por favor haz clic <a href="{{ route('informacion') }}" class="sky-blue-text">aquí</a>.</p>
</div>
<hr>
<div id="multiItemCarousel" class="carousel slide carousel-slide" data-bs-ride="carousel" data-bs-interval="6000">
    <div class="carousel-inner">
        <!-- Las imágenes del carrusel se cargarán aquí mediante JavaScript -->
    </div>
</div>
@elseif(!isset($reserva))
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
            <form id="reserva-form" action="{{ route('confirmar-solicitud', ['id' => $reserva['id'], 'action' => 'default']) }}" method="POST">                    @csrf
                    <p><strong>Solicitante:</strong> {{ $reserva['docente'] }}</p>
                    <p><strong>Número de reserva:</strong> {{ $reserva['id'] }}</p>
                    <p><strong>Fecha y hora:</strong> {{ $reserva['fecha_reserva'] }}</p>
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
                        <button type="button" class="btn btn-danger btn-lg" onclick="submitForm('rechazar')">Rechazar</button>
                        <button type="button" class="btn btn-success btn-lg" onclick="submitForm('confirmar')">Confirmar</button>
                    </div>
                </form>
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
<!-- Sección de bienvenida ya está incluida en content_header -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notificación de Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Notificación de reserva.</p>
            </div>
        </div>
    </div>
</div>
@endif
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('estilos/Docente.css') }}">
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
    
    const images = @json($images ?? '');
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
@section('footer')
<footer class="text-center" style="background-color: rgb(112, 127, 240); color: white; padding: 1px;">
    <p style="font-size: 15px;">Copyright © 2024 DevGenius. Todos los derechos son propiedad de DevGenius.</p>
</footer>
@endsection
@stop
