@extends('layouts/main')

@section('contenido')
    <h2 class="text-center mt-3 mb-4">REPORTE DE GANANCIAS Y PÉRDIDAS</h2>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('ventas') }}" class="btn btn-success d-inline-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16" role="img" aria-label="Agregar">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                    </svg>
                    Agregar venta
                </a>
                <a href="{{ route('ganancias') }}" class="btn btn-success d-inline-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
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
                <a href="{{ route('perdidas') }}" class="btn btn-danger d-inline-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                        <path
                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                    </svg>
                    Ver Pérdidas
                </a>
            </div>

            <div class="col-3">
                <div class="input-group mb-2 buscador">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-search"
                            width="28" height="28" viewBox="0 0 24 24" stroke-width="2.5" stroke="#2769A0"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <circle cx="15" cy="15" r="4" />
                            <path d="M18.5 18.5l2.5 2.5" />
                            <path d="M4 6h16" />
                            <path d="M4 12h4" />
                            <path d="M4 18h4" />
                        </svg>
                    </span>
                    <input type="text" class="form-control light-table-filter" data-table="tabla_reportes"
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

            // 🔁 ORDENAR LOS MESES DEL MÁS RECIENTE AL MÁS ANTIGUO
            $totales = collect($totales)->sortByDesc(function ($value, $key) {
                return \Carbon\Carbon::createFromFormat('Y-m', $key);
            });
        @endphp


        @forelse($totales as $mes => $data)
            <div class="card mb-5 shadow">
                <div class="card-header text-white tabla_reportes" style="background-color:#074775;">
                    @php
                        $fecha = \Carbon\Carbon::createFromFormat('Y-m', $mes);
                        $meses = [
                            'January' => 'enero',
                            'February' => 'febrero',
                            'March' => 'marzo',
                            'April' => 'abril',
                            'May' => 'mayo',
                            'June' => 'junio',
                            'July' => 'julio',
                            'August' => 'agosto',
                            'September' => 'septiembre',
                            'October' => 'octubre',
                            'November' => 'noviembre',
                            'December' => 'diciembre',
                        ];
                        $mesEsp = $meses[$fecha->format('F')];
                    @endphp

                    <strong>{{ mb_strtoupper($mesEsp . ' ' . $fecha->format('Y'), 'UTF-8') }}</strong>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered shadow text-center table_apartados tabla_reportes">
                        <thead class="table-dark">
                            <tr>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['items'] as $item)
                                <tr class="{{ $item['tipo'] === 'ganancia' ? 'table-success' : 'table-danger' }}">
                                    <td>{{ strtoupper($item['tipo']) }}</td>
                                    <td>{{ $item['descripcion'] }}</td>
                                    <td><strong>${{ number_format($item['total'], 0, ',', '.') }}</strong></td>
                                    <td>{{ $item['fecha']->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3 text-end">
                        <p><strong>Ganancias:</strong> ${{ number_format($data['ganancias'], 0, ',', '.') }}</p>
                        <p><strong>Pérdidas:</strong> ${{ number_format($data['perdidas'], 0, ',', '.') }}</p>
                        <p><strong>Total Neto:</strong>
                            <span class="{{ $data['neto'] >= 0 ? 'text-success' : 'text-danger' }}">
                                ${{ number_format($data['neto'], 0, ',', '.') }}
                            </span>
                        </p>
                        <a href="{{ route('reportes.pdf', $mes) }}" class="btn btn-primary mb-3 float-end" target="_blank">
                            Descargar PDF
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning text-center">
                No hay datos registrados para mostrar el reporte.
            </div>
        @endforelse
    </div>
@endsection




<script>
    document.addEventListener('DOMContentLoaded', function() {
        // util: debounce
        function debounce(fn, wait = 200) {
            let t;
            return function(...args) {
                clearTimeout(t);
                t = setTimeout(() => fn.apply(this, args), wait);
            };
        }

        // FILTRO 1: input .light-table-filter -> filtra filas dentro de tablas con clase 'tabla_reportes'
        (function() {
            const inputs = document.querySelectorAll('.light-table-filter[data-table="tabla_reportes"]');
            if (!inputs.length) return;

            const handle = debounce(function(ev) {
                const q = (ev.target.value || '').trim().toLowerCase();
                // todas las tablas objetivo dentro del contenedor
                const tablas = document.querySelectorAll('table.tabla_reportes');

                tablas.forEach(table => {
                    const tbody = table.tBodies[0];
                    if (!tbody) return;
                    let anyVisible = false;

                    Array.from(tbody.rows).forEach(row => {
                        const text = row.textContent.replace(/\s+/g, ' ')
                            .toLowerCase();
                        const visible = q === '' ? true : text.indexOf(q) !== -1;
                        row.style.display = visible ? '' : 'none';
                        if (visible) anyVisible = true;
                    });

                    // Si ninguna fila visible -> ocultar la tarjeta que contiene la tabla
                    const card = table.closest('.card');
                    if (card) card.style.display = anyVisible ? '' : 'none';
                });
            }, 150);

            inputs.forEach(i => i.addEventListener('input', handle));
        })();

        // FILTRO 2: input .month-filter -> filtra tarjetas (cards) por texto del encabezado (mes AÑO)
        (function() {
            const input = document.querySelector('.month-filter');
            if (!input) return;

            const handle = debounce(function(ev) {
                const q = (ev.target.value || '').trim().toLowerCase();
                const cards = document.querySelectorAll('.container .card');

                cards.forEach(card => {
                    const headerStrong = card.querySelector('.card-header strong');
                    const title = headerStrong ? headerStrong.textContent.trim()
                        .toLowerCase() : '';
                    // además buscar dentro de la tabla (por si quieres filtrar por año dentro de filas)
                    const tableText = (card.querySelector('table') ? card.querySelector(
                        'table').textContent : '').toLowerCase();
                    const matches = q === '' ? true : (title.indexOf(q) !== -1 || tableText
                        .indexOf(q) !== -1);
                    card.style.display = matches ? '' : 'none';
                });
            }, 150);

            input.addEventListener('input', handle);
        })();

        // BONUS: si se limpian ambos inputs, asegurarse de mostrar todo otra vez
        (function() {
            const light = document.querySelector('.light-table-filter[data-table="tabla_reportes"]');
            const month = document.querySelector('.month-filter');

            function resetIfEmpty() {
                if ((light && light.value.trim() === '') && (month && month.value.trim() === '')) {
                    document.querySelectorAll('.container .card').forEach(c => c.style.display = '');
                    document.querySelectorAll('table.tabla_reportes tbody tr').forEach(r => r.style
                        .display = '');
                }
            }

            if (light) light.addEventListener('input', debounce(resetIfEmpty, 220));
            if (month) month.addEventListener('input', debounce(resetIfEmpty, 220));
        })();
    });
</script>
