<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventario;
use Carbon\Carbon;

class Ventas extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 🔍 Validación de los datos recibidos
        $request->validate([
            'producto_venta'   => 'required|array',
            'cantidad'         => 'required|array',
            'producto_venta.*' => 'nullable|exists:inventarios,id',
            'cantidad.*'       => 'nullable|integer|min:1',
        ]);

        $productos = [];
        $granTotal = 0;

        foreach ($request->producto_venta as $index => $productoId) {
            if (!empty($productoId) && !empty($request->cantidad[$index])) {

                $producto = Inventario::find($productoId);
                $cantidadVendida = (int) $request->cantidad[$index];

                if ($producto) {

                    // ⚠️ Verificamos que haya suficiente stock
                    if ($producto->cantidad < $cantidadVendida) {
                        return redirect()->back()->with('error', "No hay suficiente stock de {$producto->nombre}");
                    }

                    // 💾 Restamos la cantidad vendida del inventario
                    $producto->cantidad -= $cantidadVendida;
                    $producto->save();

                    // 💰 Calculamos el total del producto
                    $precio = $producto->preciounidad;
                    $total  = $precio * $cantidadVendida;

                    $productos[] = [
                        'id'       => $producto->id,
                        'nombre'   => $producto->nombre,
                        'precio'   => $precio,
                        'cantidad' => $cantidadVendida,
                        'total'    => $total,
                    ];

                    $granTotal += $total;
                }
            }
        }

        // ✅ Guardamos la venta solo si hay productos válidos
        if (count($productos) > 0) {
            Ventas::create([
                'productos'   => json_encode($productos, JSON_UNESCAPED_UNICODE),
                'gran_total'  => $granTotal,
                'fecha'       => Carbon::now(),
            ]);
        }

        return redirect()->back()->with('success', 'Venta registrada y stock actualizado correctamente.');
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
