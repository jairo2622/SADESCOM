<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte {{ $mes }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #2769A0;
            color: white;
        }

        .ganancia {
            background-color: #d4edda;
        }

        .perdida {
            background-color: #f8d7da;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
        }

        h3 {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    @php
        use Carbon\Carbon;

        // Si $mes viene en formato "2025-10", lo convertimos a un objeto Carbon
        try {
            $carbonMes = Carbon::createFromFormat('Y-m', $mes);
        } catch (\Exception $e) {
            $carbonMes = Carbon::parse($mes);
        }

        // Traducción manual de los meses al español
        $meses = [
            1 => 'ENERO',
            2 => 'FEBRERO',
            3 => 'MARZO',
            4 => 'ABRIL',
            5 => 'MAYO',
            6 => 'JUNIO',
            7 => 'JULIO',
            8 => 'AGOSTO',
            9 => 'SEPTIEMBRE',
            10 => 'OCTUBRE',
            11 => 'NOVIEMBRE',
            12 => 'DICIEMBRE',
        ];

        $mesEnEspanol = $meses[$carbonMes->month] . ' ' . $carbonMes->year;
    @endphp

    <h2>REPORTE DE {{ $mesEnEspanol }}</h2>

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                @php
                    $tipo = strtoupper(str_replace('pérdida', 'perdida', $item['tipo']));
                @endphp
                <tr class="{{ strtolower($tipo) }}">
                    <td>{{ $tipo }}</td>
                    <td>
                        @if ($tipo === 'GANANCIA')
                            {{-- Las ganancias provienen de productos JSON --}}
                            @php
                                $desc = is_string($item['descripcion'])
                                    ? json_decode($item['descripcion'], true)
                                    : $item['descripcion'];
                            @endphp

                            @if (is_array($desc))
                                <ul>
                                    @foreach ($desc as $producto)
                                        <li>
                                            {{ $producto['nombre'] ?? ($producto['descripcion'] ?? json_encode($producto, JSON_UNESCAPED_UNICODE)) }}
                                            (Cant: {{ $producto['cantidad'] ?? 1 }}, Precio:
                                            ${{ number_format($producto['precio'] ?? 0, 0, ',', '.') }})
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                {{ $desc }}
                            @endif
                        @else
                            {{-- Las pérdidas ya son texto o array simple --}}
                            @if (is_array($item['descripcion']))
                                <ul>
                                    @foreach ($item['descripcion'] as $d)
                                        <li>{{ is_array($d) ? $d['descripcion'] ?? json_encode($d, JSON_UNESCAPED_UNICODE) : $d }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                {{ $item['descripcion'] }}
                            @endif
                        @endif
                    </td>
                    <td>${{ number_format($item['total'], 0, ',', '.') }}</td>
                    <td>{{ $item['fecha']->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Resumen del mes:</h3>
    <p><strong>Ganancias:</strong> ${{ number_format($ganancias ?? 0, 0, ',', '.') }}</p>
    <p><strong>Perdidas:</strong> ${{ number_format($perdidas ?? 0, 0, ',', '.') }}</p>
    <p><strong>Total Neto:</strong>
        <span style="color: {{ ($neto ?? 0) >= 0 ? 'green' : 'red' }};">
            ${{ number_format($neto ?? 0, 0, ',', '.') }}
        </span>
    </p>
</body>

</html>
