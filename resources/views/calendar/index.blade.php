@extends('adminlte::page')

@section('title', 'Calendario')

@section('content_header')
    <h1>Calendario</h1>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <div id="calendar"></div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                locale: 'es', // Configurar el idioma español
                defaultView: 'month',
                events: '/events',
                editable: true,
                eventLimit: true,
                eventDrop: function(event) {
                    var eventData = {
                        id: event.id,
                        start: event.start.format(),
                        end: event.end ? event.end.format() : null
                    };
                    $.ajax({
                        url: '/events/' + event.id,
                        data: eventData,
                        type: 'PUT',
                        success: function(response) {
                            Swal.fire({
                                title: 'Evento actualizado',
                                text: 'El evento se actualizó correctamente.',
                                icon: 'success',
                                timer: 1000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Error',
                                text: 'Error al actualizar el evento.',
                                icon: 'error',
                                showConfirmButton: true
                            });
                        }
                    });
                },
                eventClick: function(event) {
                    Swal.fire({
                        title: event.title,
                        html: `<p>Inicio: ${event.start.format('YYYY-MM-DD HH:mm')}</p>
                               <p>Fin: ${event.end ? event.end.format('YYYY-MM-DD HH:mm') : 'N/A'}</p>
                               <p>Descripción: ${event.description || 'Sin descripción'}</p>`,
                        icon: 'info',
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Editar',
                        cancelButtonText: 'Eliminar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Lógica para editar el evento puede ir aquí
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            $.ajax({
                                url: '/events/' + event.id,
                                type: 'DELETE',
                                success: function(response) {
                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                    Swal.fire({
                                        title: 'Evento eliminado',
                                        text: 'El evento se eliminó correctamente.',
                                        icon: 'success',
                                        timer: 1000,
                                        timerProgressBar: true,
                                        showConfirmButton: false
                                    });
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Error al eliminar el evento.',
                                        icon: 'error',
                                        showConfirmButton: true
                                    });
                                }
                            });
                        }
                    });
                },
                dayClick: function(date, jsEvent, view) {
                    // Obtener los eventos del día seleccionado
                    var events = $('#calendar').fullCalendar('clientEvents', function(event) {
                        return event.start.isSame(date, 'day');
                    });

                    if (events.length > 0) {
                        let eventDetails = events.map(event => 
                            `<p><strong>${event.title}</strong><br>
                            Inicio: ${event.start.format('YYYY-MM-DD HH:mm')}<br>
                            Fin: ${event.end ? event.end.format('YYYY-MM-DD HH:mm') : 'N/A'}<br>
                            Descripción: ${event.description || 'Sin descripción'}</p>`
                        ).join('<hr>');

                        Swal.fire({
                            title: 'Eventos del día',
                            html: eventDetails,
                            icon: 'info',
                            showCloseButton: true,
                        });
                    } else {
                        Swal.fire({
                            title: 'Sin eventos',
                            text: 'No hay eventos para este día.',
                            icon: 'info',
                            showCloseButton: true,
                        });
                    }
                },
                eventRender: function(event, element) {
                    element.css('background-color', event.color);
                    element.css('border-color', event.color);
                }
            });
        });
    </script>
@stop
