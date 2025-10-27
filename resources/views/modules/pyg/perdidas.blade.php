@extends('layouts/main')

@section('contenido')
    <h2 class="text-center mt-3 mb-4">PÉRDIDAS</h2>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('reportes') }}" class="btn btn-primary d-inline-flex align-items-center gap-1"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                        <path
                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                    </svg>
                    Ver Reportes
                </a>
                <a href="{{ route('ventas') }}" class="btn btn-success d-inline-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16" role="img" aria-label="Agregar">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                    </svg>
                    Agregar venta
                </a>
                <a href="{{ route('ganancias') }}" class="btn btn-success d-inline-flex align-items-center gap-1"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                        <path
                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                    </svg>
                    Ver Ganancias
                </a>
                <a href="{{ route('createperdida') }}" class="btn btn-danger d-inline-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16" role="img" aria-label="Agregar">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                    </svg>
                    Agregar pérdidas
                </a>
            </div>

            <div class="col-3">
                <div class="input-group mb-2 buscador">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-list-search" width="28" height="28"
                            viewBox="0 0 24 24" stroke-width="2.5" stroke="#2769A0" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <circle cx="15" cy="15" r="4" />
                            <path d="M18.5 18.5l2.5 2.5" />
                            <path d="M4 6h16" />
                            <path d="M4 12h4" />
                            <path d="M4 18h4" />
                        </svg></span>
                    <input type="text" class="form-control light-table-filter" data-table="tabla_pyg"
                        placeholder="Busqueda">
                </div>
            </div>

            <div class="col-3">
                <div class="input-group mb-2 buscador">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-search"
                            width="28" height="28" viewBox="0 0 24 24" stroke-width="2.5" stroke="#2769A0"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M4 5h16a1 1 0 0 1 1 1v9a6 6 0 1 1 -7.743 5.743h-9.257a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1z" />
                            <path d="M16 3v4" />
                            <path d="M8 3v4" />
                            <path d="M4 11h16" />
                            <circle cx="16" cy="19" r="2" />
                            <path d="M18.5 21.5l2.5 2.5" />
                        </svg>
                    </span>
                    <input type="text" class="form-control month-filter" placeholder="Buscar por mes o año">
                </div>
            </div>
        </div>

        @php
            use Carbon\Carbon;
            Carbon::setLocale('es');

            $perdidasAgrupadas = $items->groupBy(function ($perdida) {
                return Carbon::parse($perdida->created_at)->format('Y-m');
            });
        @endphp

        @foreach ($perdidasAgrupadas as $periodo => $perdidas)
            @php
                $fechaTitulo = Carbon::createFromFormat('Y-m', $periodo)->translatedFormat('F Y');
            @endphp

            <h2 class="mt-4 month-title" data-periodo="{{ strtolower($fechaTitulo) }}">
                {{ strtoupper($fechaTitulo) }}
            </h2>

            <table class="table table-striped table-bordered text-center shadow tabla_pyg table_apartados">
                <thead class="table-dark">
                    <tr>
                        <th>Gastos</th>
                        <th>Gran Total</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($perdidas as $item)
                        <tr>
                            <td>
                                <table class="table table-sm table-bordered mb-0 table_apartados">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $descripciones = is_array($item->descripcion)
                                                ? $item->descripcion
                                                : json_decode($item->descripcion, true) ?? [];
                                            $totales = is_array($item->total)
                                                ? $item->total
                                                : json_decode($item->total, true) ?? [];
                                        @endphp

                                        @foreach ($descripciones as $index => $desc)
                                            <tr>
                                                <td>{{ $desc ?? '' }}</td>
                                                <td>${{ number_format($totales[$index] ?? 0, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td><strong>${{ number_format($item->gran_total, 0, ',', '.') }}</strong></td>
                            <td>{{ Carbon::parse($item->created_at)->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection
