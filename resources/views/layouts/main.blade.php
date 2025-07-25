<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SADESCOM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    @vite('resources/css/app.css')


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
                        <a class="nav-link" href="#">Ventas</a>
                    </li>
                    <li class="nav-item apartados">
                        <a class="nav-link" href="#">PyG</a>
                    </li>
                </ul>
            </div>
            <div class="col-10 contenido">
                @yield('contenido')
            </div>
        </div>
    </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
</script>
    <script>
        function ConfirmarEliminacion() {

            var respuesta = confirm("¿Seguro que deseas eliminar a este proveedor?");
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

        })(document);
    </script>
</html>
