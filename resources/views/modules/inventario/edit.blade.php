@extends('layouts/main')

@section('contenido')
    <h2>ACTUALIZAR INFORMACIÓN DE {{ $item->nombre }}</h2>

    <div class="container">
        <form action="{{ route('updateinventario', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="nombre">Nombre del producto</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $item->nombre }}" required>

            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $item->cantidad }}"
                required>

            <label for="preciounidad">Precio unitario</label>
            <input type="number" name="preciounidad" id="preciounidad" class="form-control"
                value="{{ $item->preciounidad }}" required>

            <label for="proveedor">Proveedor</label>
            <input type="text" name="proveedor" id="proveedor" class="form-control" value="{{ $item->proveedor }}"
                required>

            <label for="perecedero">Perecedero</label><br>
            <select name="perecedero" id="perecedero" required>
                <option value="Si" @selected($item->perecedero === 'Si')>Si</option>
                <option value="No" @selected($item->perecedero === 'No')>No</option>
            </select><br><br>


            <div id="fechavencimiento-group">
                <label for="fechavencimiento">Fecha de vencimiento</label>
                <input type="date" name="fechavencimiento" id="fechavencimiento" class="form-control"
                    value="{{ $item->fechavencimiento }}">
            </div>

            <input type="hidden" name="fechavencimiento_fallback" value="2026-01-01">

            <button class="btn btn-primary mt-3">Actualizar</button>
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
