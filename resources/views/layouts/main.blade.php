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

</html>
