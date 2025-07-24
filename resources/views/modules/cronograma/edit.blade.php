@extends('layouts/main')

@section('contenido')
    <h2>ACTUALIZAR EVENTO {{ $item->title }}</h2>

    <div class="container">
        <form action="{{ route('updatecronograma', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="title">Titulo</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ $item->title }}">

            <label for="description">Descripción</label>
            <input type="" name="description" id="description" class="form-control" required value="{{ $item->description }}">

            <label for="start">Inicio del evento</label>
            <input type="datetime-local" name="start" id="start" class="form-control" required value="{{ $item->start }}">

            <label for="end">Final del evento</label>
            <input type="datetime-local" name="end" id="end" class="form-control" required value="{{ $item->end }}">

            <label for="color">Color de fondo</label>
            <input type="color" name="color" id="color" class="form-control colores" required value="{{ $item->color }}">

            <label for="textcolor">Color del texto</label>
            <input type="color" name="textcolor" id="textcolor" class="form-control colores" required value="{{ $item->textcolor }}">

            <button class="btn btn-primary mt-3">Actualizar</button>
            <a href="{{ route('cronograma') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
@endsection
