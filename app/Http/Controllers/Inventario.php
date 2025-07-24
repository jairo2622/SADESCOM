<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventario as ModelsInventario;
use Illuminate\Http\Request;

class Inventario extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ModelsInventario::paginate(10);
        return view('modules/inventario/index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules/inventario/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = new ModelsInventario();
        $item->nombre = $request->nombre;
        $item->cantidad = $request->cantidad;
        $item->preciounidad = $request->preciounidad;
        $item->proveedor = $request->proveedor;
        $item->perecedero = $request->perecedero;
        $item->fechavencimiento = $request->fechavencimiento?: $request->input('fechavencimiento_fallback');

        $item->save();
        return to_route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item=ModelsInventario::find($id);
        return view('modules/inventario/show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=ModelsInventario::find($id);
        return view('modules/inventario/edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=ModelsInventario::find($id);
        $item->nombre = $request->nombre;
        $item->cantidad = $request->cantidad;
        $item->preciounidad = $request->preciounidad;
        $item->proveedor = $request->proveedor;
        $item->perecedero = $request->perecedero;
        $item->fechavencimiento = $request->fechavencimiento?: $request->input('fechavencimiento_fallback');
        $item->save();
        return to_route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=ModelsInventario::find($id);
        $item->delete();
        return to_route('index');
    }
}
