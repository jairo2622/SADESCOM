<?php

use App\Http\Controllers\Cronograma;
use App\Http\Controllers\Inventario;
use App\Http\Controllers\Proveedores;
use App\Models\Cronograma as ModelsCronograma;
use Illuminate\Support\Facades\Route;

Route::get('/', [Inventario::class, 'index'])->name('index');
Route::get('/create', [Inventario::class, 'create'])->name('createinventario');
Route::post('/store', [Inventario::class, 'store'])->name('storeinventario');
Route::get('/show/{id}', [Inventario::class, 'show'])->name('showinventario');
Route::get('/edit/{id}', [Inventario::class, 'edit'])->name('editinventario');
Route::put('/update/{id}', [Inventario::class, 'update'])->name('updateinventario');
Route::delete('/destroy/{id}', [Inventario::class, 'destroy'])->name('destroyinventario');


Route::get('/proveedores', [Proveedores::class, 'index'])->name('proveedores');
Route::get('/proveedores/create', [Proveedores::class, 'create'])->name('createproveedores');
Route::post('/proveedores/store', [Proveedores::class, 'store'])->name('storeproveedores');
Route::get('/proveedores/show/{id}', [Proveedores::class, 'show'])->name('showproveedores');
Route::get('/proveedores/edit/{id}', [Proveedores::class, 'edit'])->name('editproveedores');
Route::put('/proveedores/update/{id}', [Proveedores::class, 'update'])->name('updateproveedores');
Route::delete('/proveedores/destroy/{id}', [Proveedores::class, 'destroy'])->name('destroyproveedores');


Route::get('/cronograma', [Cronograma::class, 'index'])->name('cronograma');


Route::get('/cronogramaEventos', function () {
    $eventos = ModelsCronograma::all();

    $eventosFormateados = $eventos->map(function ($evento) {
        return [
            'id' => $evento->id,
            'title' => $evento->title,
            'description' => $evento->description,
            'start' => $evento->start,
            'end' => $evento->end,
            'color' => $evento->color,
            'textColor' => $evento->textcolor,
        ];
    });

    return response()->json($eventosFormateados);
})->name('cronogramaEventos');


Route::get('/cronograma/create', [Cronograma::class, 'create'])->name('createcronograma');
Route::post('/cronograma/store', [Cronograma::class, 'store'])->name('storecronograma');
Route::get('/cronograma/edit/{id}', [Cronograma::class, 'edit'])->name('editcronograma');
Route::put('/cronograma/update/{id}', [Cronograma::class, 'update'])->name('updatecronograma');
Route::get('/cronograma/destroy/{id}', [Cronograma::class, 'destroy'])->name('destroycronograma');

Route::get('/ventas', function () {
    $items = \App\Models\Inventario::all();
    return view('modules/ventas/index', compact('items'));
})->name('ventas');
