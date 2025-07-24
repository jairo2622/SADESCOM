@extends('layouts/main')

@section('contenido')
    <h2>AGREGAR PRODUCTO</h2>

    <div class="container">
        <form action="{{ route('storeinventario') }}" method="POST">
            @csrf
            @method('POST')
            <label for="nombre">Nombre del producto</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>

            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" required>

            <label for="preciounidad">Precio unitario</label>
            <input type="number" name="preciounidad" id="preciounidad" class="form-control" required>

            <label for="proveedor">Proveedor</label>
            <input type="text" name="proveedor" id="proveedor" class="form-control" required>

            <label for="perecedero">Perecedero</label><br>
            <select name="perecedero" id="perecedero" required>
                <option>Si</option>
                <option>No</option>
            </select><br><br>

            <div id="fechavencimiento-group">
                <label for="fechavencimiento">Fecha de vencimiento</label>
                <input type="date" name="fechavencimiento" id="fechavencimiento" class="form-control">
            </div>

            <input type="hidden" name="fechavencimiento_fallback" value="2026-01-01">

            <button class="btn btn-primary mt-3">Agregar</button>
            <a href="{{ route('index') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('perecedero');
        const group = document.getElementById('fechavencimiento-group');

        function toggleFechaVencimiento() {
            if (select.value === 'Si') {
                group.style.display = 'block';
            } else {
                group.style.display = 'none';
            }
        }

        select.addEventListener('change', toggleFechaVencimiento);
        toggleFechaVencimiento(); // Ejecutar en carga inicial
    });
</script>
