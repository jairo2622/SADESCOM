<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proveedores as ModelsProveedores;
use Illuminate\Http\Request;

class proveedores extends Controller
{
    /**
     */
    public function index()
    {
        $items = ModelsProveedores::paginate(10);
        return view('modules/proveedores/index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules/proveedores/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $item = new ModelsProveedores();
        $item->nombre = $request->nombre;
        $item->productos = $request->productos;
        $item->email = $request->email;
        $item->telefono1 = $request->telefono1;
        $item->telefono2 = $request->telefono2;

        $item->save();
        return to_route('proveedores');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = ModelsProveedores::find($id);
        return view('modules/proveedores/show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = ModelsProveedores::find($id);
        return view('modules/proveedores/edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = ModelsProveedores::find($id);
        $item->nombre = $request->nombre;
        $item->productos = $request->productos;
        $item->email = $request->email;
        $item->telefono1 = $request->telefono1;
        $item->telefono2 = $request->telefono2;
        $item->save();
        return to_route('proveedores');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = ModelsProveedores::find($id);
        $item->delete();
        return to_route('proveedores');
    }
}
