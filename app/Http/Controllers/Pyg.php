<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Pyg extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = \App\Models\Pyg::orderBy('created_at', 'desc')->get();
        return view('modules.pyg.perdidas', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules/pyg/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación inicial
        $request->validate([
            'descripcion' => 'required|array',
            'total'       => 'required|array',
        ]);

        $descripcionesFiltradas = [];
        $totalesFiltrados = [];

        // Recorremos los campos y eliminamos los vacíos
        foreach ($request->descripcion as $index => $desc) {
            $total = $request->total[$index] ?? null;

            // Solo guardamos si hay descripción Y un total válido
            if (!empty($desc) && $total !== null && $total !== '') {
                $descripcionesFiltradas[] = $desc;
                $totalesFiltrados[] = (float) $total;
            }
        }

        // Si después de filtrar no hay datos, no guardamos nada
        if (empty($descripcionesFiltradas)) {
            return redirect()->back()->with('error', 'Debes ingresar al menos una pérdida válida.');
        }

        // Calcular el gran total
        $granTotal = array_sum($totalesFiltrados);

        // Guardar en la base de datos
        \App\Models\Pyg::create([
            'descripcion' => $descripcionesFiltradas,
            'total'       => $totalesFiltrados,
            'gran_total'  => $granTotal,
        ]);

        return redirect()->back()->with('success', 'Registro de pérdidas guardado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
