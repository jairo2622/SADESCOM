@extends('layouts/main')

@section('contenido')
    <h2 class="text-center mt-3 mb-4">AGREGAR EVENTO</h2>

    <div class="container">
        <form action="{{ route('storecronograma') }}" method="POST" class="formularios">
            @csrf
            @method('POST')
            <label for="title">Titulo</label>
            <input type="text" name="title" id="title" class="form-control" required>

            <label for="description">Descripción</label>
            <input type="" name="description" id="description" class="form-control" required>

            <label for="start">Inicio del evento</label>
            <input type="datetime-local" name="start" id="start" class="form-control" required>

            <label for="end">Final del evento</label>
            <input type="datetime-local" name="end" id="end" class="form-control" required>

            <label for="color">Color de fondo</label>
            <input type="color" name="color" id="color" class="form-control colores" required value="#0463c8">

            <label for="textcolor">Color del texto</label>
            <input type="color" name="textcolor" id="textcolor" class="form-control colores" required value="#ffffff">

            <button class="btn btn-primary mt-3">Agregar</button>
            <a href="{{ route('cronograma') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
@endsection
