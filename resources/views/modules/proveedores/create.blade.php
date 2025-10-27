@extends('layouts/main')

@section('contenido')
    <h2 class="text-center mt-3 mb-4">AGREGAR PROVEEDOR</h2>

    <div class="container">
        <form action="{{ route('storeproveedores') }}" method="POST" class="formularios">
            @csrf
            @method('POST')
            <label for="nombre">Nombre del proveedor</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>

            <label for="productos">Productos que vende</label>
            <input type="" name="productos" id="productos" class="form-control" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>

            <label for="telefono1">Telefono 1</label>
            <input type="text" name="telefono1" id="telefono1" class="form-control" required>

            <label for="telefono2">Telefono 2</label>
            <input type="text" name="telefono2" id="telefono2" class="form-control" required>

            <button class="btn btn-primary mt-3">Agregar</button>
            <a href="{{ route('proveedores') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
@endsection
