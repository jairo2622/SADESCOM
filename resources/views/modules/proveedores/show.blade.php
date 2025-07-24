@extends('layouts/main')

@section('contenido')
    <h2>INFORMACIÓN DEL PROVEEDOR {{ $item->nombre }}</h2>

    <div class="container">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>Nombre del proveedor</th>
                    <th>Productos</th>
                    <th>Email</th>
                    <th>Telefono 1</th>
                    <th>Telefono 2</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->productos }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->telefono1 }}</td>
                    <td>{{ $item->telefono2 }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('proveedores') }}" class="btn btn-primary mt-3">Volver</a>
    </div>
@endsection
