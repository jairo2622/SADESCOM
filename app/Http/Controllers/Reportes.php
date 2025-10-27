<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Ventas;
use App\Models\PyG;
use Carbon\Carbon;

class Reportes extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 🟢 GANANCIAS
        $ventas = Ventas::select('productos', 'gran_total', 'created_at')
            ->get()
            ->map(function ($venta) {
                // Laravel ya entrega 'productos' como array si el campo es tipo JSON
                $productos = is_string($venta->productos)
                    ? json_decode($venta->productos, true)
                    : $venta->productos;

                $descripcion = collect($productos)->pluck('nombre')->implode(', ');
                if (empty($descripcion)) {
                    $descripcion = 'Venta sin detalle';
                }

                return [
                    'tipo' => 'ganancia',
                    'descripcion' => $descripcion,
                    'total' => (float) $venta->gran_total,
                    'fecha' => Carbon::parse($venta->created_at),
                ];
            });

        // 🔴 PÉRDIDAS
        $perdidas = PyG::select('descripcion', 'gran_total', 'created_at')
            ->get()
            ->map(function ($p) {
                $descripcion = is_string($p->descripcion)
                    ? json_decode($p->descripcion, true)
                    : $p->descripcion;

                if (is_array($descripcion)) {
                    $descripcion = implode(', ', $descripcion);
                }

                if (empty($descripcion)) {
                    $descripcion = 'Gasto sin detalle';
                }

                return [
                    'tipo' => 'perdida',
                    'descripcion' => $descripcion,
                    'total' => (float) $p->gran_total,
                    'fecha' => Carbon::parse($p->created_at),
                ];
            });

        // 🔹 Combinar ambas colecciones
        $todos = $ventas->merge($perdidas);

        // 🔹 Agrupar por mes y calcular totales
        $totales = $todos->groupBy(function ($item) {
            return $item['fecha']->format('Y-m');
        })->map(function ($grupo) {
            $ganancias = $grupo->where('tipo', 'ganancia')->sum('total');
            $perdidas = $grupo->where('tipo', 'perdida')->sum('total');
            $neto = $ganancias - $perdidas;

            return [
                'items' => $grupo,
                'ganancias' => $ganancias,
                'perdidas' => $perdidas,
                'neto' => $neto,
            ];
        });

        return view('modules/reportes/reportes', compact('totales'));
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
        //
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

    public function generarPDF($mes)
    {
        // Obtener los datos de ventas (ganancias)
        $ventas = \App\Models\Ventas::select('productos', 'gran_total', 'created_at')
            ->get()
            ->map(function ($venta) {
                $productos = is_array($venta->productos) ? $venta->productos : json_decode($venta->productos, true);
                return [
                    'tipo' => 'ganancia',
                    'descripcion' => $productos,
                    'total' => $venta->gran_total,
                    'fecha' => Carbon::parse($venta->created_at),
                ];
            });

        // Obtener las pérdidas (ahora "perdidas" sin tilde)
        $perdidas = \App\Models\Pyg::select('descripcion', 'total', 'gran_total', 'created_at')
            ->get()
            ->map(function ($p) {
                $descripciones = is_array($p->descripcion) ? $p->descripcion : json_decode($p->descripcion, true);
                $totales = is_array($p->total) ? $p->total : json_decode($p->total, true);
                return [
                    'tipo' => 'perdida', // 🔹 corregido aquí
                    'descripcion' => $descripciones,
                    'total' => $p->gran_total,
                    'fecha' => Carbon::parse($p->created_at),
                ];
            });

        // Combinar ambas colecciones
        $todos = $ventas->merge($perdidas);

        // Filtrar solo los datos del mes indicado
        $filtrados = $todos->filter(function ($item) use ($mes) {
            return $item['fecha']->format('Y-m') === $mes;
        });

        // Calcular totales del mes
        $ganancias = $filtrados->where('tipo', 'ganancia')->sum('total');
        $perdidas = $filtrados->where('tipo', 'perdida')->sum('total');
        $neto = $ganancias - $perdidas;

        // Obtener nombre del mes en mayúsculas y en español
        $nombreMes = mb_strtoupper(Carbon::createFromFormat('Y-m', $mes)->translatedFormat('F Y'), 'UTF-8');

        // Crear el PDF con los datos
        $pdf = Pdf::loadView('modules/reportes/pdf', [
            'mes' => $nombreMes,
            'items' => $filtrados,
            'ganancias' => $ganancias,
            'perdidas' => $perdidas,
            'neto' => $neto
        ]);

        // Mostrar el PDF en el navegador (o podrías usar ->download para descargar)
        return $pdf->stream("Reporte_$mes.pdf");
    }
}
