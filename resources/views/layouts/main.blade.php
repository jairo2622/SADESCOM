<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SADESCOM</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset('images/icono2.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- FullCalendar CSS -->
    <link href="{{ asset('css/daygrid/index.global.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/timegrid/index.global.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/list/index.global.min.css') }}" rel="stylesheet">


    <!-- FullCalendar JS -->
    <script src="{{ asset('js/index.global.min.js') }}"></script>
    <script src="{{ asset('js/locales-all.global.min.js') }}"></script>
    <script src="{{ asset('js/daygrid/index.global.min.js') }}"></script>
    <script src="{{ asset('js/timegrid/index.global.min.js') }}"></script>
    <script src="{{ asset('js/list/index.global.min.js') }}"></script>

    <!-- Tu script de inicialización -->
    <script src="{{ asset('js/app.js') }}"></script>


    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="container-fluid justify-content-start" id="navbarNavDropdown">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo de SADESCOM">
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col-2 colmuna1">
                <ul class="nav flex-column justify-content-center align-items-center">
                    <li class="nav-item apartados">
                        <a class="nav-link" href="{{ route('index') }}">Inventario</a>
                    </li>
                    <li class="nav-item apartados">
                        <a class="nav-link" href="{{ route('proveedores') }}">Proveedores</a>
                    </li>
                    <li class="nav-item apartados">
                        <a class="nav-link" href="{{ route('cronograma') }}">Cronograma</a>
                    </li>
                    <li class="nav-item apartados">
                        <a class="nav-link" href="{{ route('ventas') }}">Ventas</a>
                    </li>
                    <li class="nav-item apartados">
                        <a class="nav-link" href="{{ route('reportes') }}">Reportes PYG</a>
                    </li>
                </ul>
            </div>
            <div class="col-10 contenido">
                @yield('contenido')
            </div>
        </div>
    </div>



</body>

<script>
    function ConfirmarEliminacionProveedores() {

        var respuesta = confirm("¿Seguro que deseas eliminar a este proveedor?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }

    function ConfirmarEliminacionProductos() {

        var respuesta = confirm("¿Seguro que deseas eliminar a este producto?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }

    (function(document) {
        'buscador';

        var LightTableFilter = (function(Arr) {

            var _input;

            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function(table) {
                    Arr.forEach.call(table.tBodies, function(tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }

            function _filter(row) {
                var text = row.textContent.toLowerCase(),
                    val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }

            return {
                init: function() {
                    var inputs = document.getElementsByClassName('light-table-filter');
                    Arr.forEach.call(inputs, function(input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);

        document.addEventListener('readystatechange', function() {
            if (document.readyState === 'complete') {
                LightTableFilter.init();
            }
        });

        const monthInput = document.querySelector('.month-filter');
        if (monthInput) {
            monthInput.addEventListener('input', function() {
                const value = this.value.toLowerCase();
                const sections = document.querySelectorAll('.month-title');

                sections.forEach(section => {
                    const periodo = section.getAttribute('data-periodo').toLowerCase();
                    const table = section.nextElementSibling;

                    // Mostrar u ocultar según coincidencia
                    if (periodo.includes(value) || value === '') {
                        section.style.display = '';
                        if (table) table.style.display = '';
                    } else {
                        section.style.display = 'none';
                        if (table) table.style.display = 'none';
                    }
                });
            });
        }

    })(document);
</script>

</html>
