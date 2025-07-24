@extends('layouts/main')

@section('contenido')
    <h2>INFORMACIÓN DE {{ $item->nombre }}</h2>

    <div class="container">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unidad</th>
                    <th>Proveedor</th>
                    <th>Perecedero</th>
                    <th>Vencimiento</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->preciounidad }}</td>
                    <td>{{ $item->proveedor }}</td>
                    <td>{{ $item->perecedero }}</td>
                    <td>
                        @if ($item->perecedero === 'Si')
                            {{ $item->fechavencimiento }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('index') }}" class="btn btn-primary mt-3">Volver</a>
    </div>
@endsection
