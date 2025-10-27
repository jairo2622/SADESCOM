@extends('layouts/main')

@section('contenido')
    <h2 class="text-center mt-3 mb-4" style="margin-left: -80px">CRONOGRAMA</h2>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: "es",
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                eventSources: [{
                    url: '{{ route('cronogramaEventos') }}'
                }],
                eventClick: function(info) {
                    var eventObj = info.event;
                    var id = eventObj.id;

                    Swal.fire({
                        title: 'Evento: ' + eventObj.title,
                        html: `
                            <p><strong>Descripción:</strong> ${eventObj.extendedProps.description}</p>
                            <p><strong>Inicio:</strong> ${eventObj.start}</p>
                            <p><strong>Finalización:</strong> ${eventObj.end}</p>
                        `,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Editar',
                        cancelButtonText: 'Cerrar',
                        showDenyButton: true,
                        denyButtonText: 'Eliminar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `/cronograma/edit/${id}`;
                        } else if (result.isDenied) {
                            window.location.href = `/cronograma/destroy/${id}`;
                        }
                    });
                }
            });

            calendar.render();
        });
    </script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2">
                <a href="{{ route('createcronograma') }}" class="btn btn-primary d-inline-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16" role="img" aria-label="Agregar">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                    </svg>
                    Agregar evento
                </a>
            </div>
            <div class="col-5"></div>

            <div class="col-2"></div>
            <div class="col-8">
                <div id='calendar'></div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <script>
        function ConfirmarEliminacion() {

            var respuesta = confirm("¿Seguro que deseas eliminar a este proveedor?");
            if (respuesta == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
