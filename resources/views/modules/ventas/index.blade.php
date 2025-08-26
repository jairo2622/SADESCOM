@extends('layouts/main')

@section('contenido')
    <div class="container">
        <form action="" method="POST">
            @csrf
            <table class="table table-striped table-bordered text-center" id="tabla_ventas">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unidad</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="body_ventas">
                    <tr>
                        <td class="columna_ventas">
                            <select name="producto_venta[]" class="form-select producto_venta">
                                <option value="">---Selecciona un producto---</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="columna_ventas precio_unidad">-</td>
                        <td class="columna_ventas">
                            <input type="number" name="cantidad[]" class="form-control cantidad" placeholder="0"
                                min="1" required>
                        </td>
                        <td class="columna_ventas total">-</td>
                    </tr>
                </tbody>

                {{-- Fila de Gran Total --}}
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Gran Total:</strong></td>
                        <td class="bg-primary" id="gran_total"><strong>-</strong></td>
                    </tr>
                    {{-- 🔹 Nueva fila: Pago del cliente --}}
                    <tr>
                        <td colspan="3" class="text-end"><strong>Pago del Cliente:</strong></td>
                        <td><input type="number" id="pago_cliente" class="form-control" min="0" placeholder="0"></td>
                    </tr>
                    {{-- 🔹 Nueva fila: Cambio --}}
                    <tr>
                        <td colspan="3" class="text-end"><strong>Cambio:</strong></td>
                        <td class="bg-primary" id="cambio"><strong>-</strong></td>
                    </tr>
                </tfoot>
            </table>

            <button type="submit" class="btn btn-primary">Confirmar Venta</button>
            {{-- 🔹 Nuevo botón para limpiar --}}
            <button type="button" class="btn btn-danger" id="btn_cancelar">Cancelar Venta</button>
        </form>
    </div>

    <script>
        const precios = @json($items->pluck('preciounidad', 'id'));

        // Función para calcular el total de una fila
        function calcularTotal(fila) {
            const precio = parseFloat(fila.querySelector('.precio_unidad').textContent) || 0;
            const cantidad = parseInt(fila.querySelector('.cantidad').value) || 0;
            const total = precio * cantidad;
            fila.querySelector('.total').textContent = total > 0 ? total : '-';

            calcularGranTotal(); // ✅ Actualizar el Gran Total
        }

        // Función para calcular el Gran Total
        function calcularGranTotal() {
            let suma = 0;
            document.querySelectorAll('#body_ventas .total').forEach(td => {
                const valor = parseFloat(td.textContent);
                if (!isNaN(valor)) suma += valor;
            });
            document.getElementById('gran_total').textContent = suma > 0 ? suma : '-';
            calcularCambio(); // 🔹 recalcular cambio cada vez que cambie el total
        }

        // 🔹 Función para calcular el cambio
        function calcularCambio() {
            const granTotal = parseFloat(document.getElementById('gran_total').textContent) || 0;
            const pago = parseFloat(document.getElementById('pago_cliente').value) || 0;
            const cambio = pago - granTotal;
            document.getElementById('cambio').textContent = (cambio >= 0) ? cambio : '-';
        }

        // Función para agregar nueva fila
        function agregarFila() {
            const tbody = document.getElementById('body_ventas');
            const fila = document.createElement('tr');

            fila.innerHTML = `
                <td class="columna_ventas">
                    <select name="producto_venta[]" class="form-select producto_venta">
                        <option value="">---Selecciona un producto---</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="columna_ventas precio_unidad">-</td>
                <td class="columna_ventas">
                    <input type="number" name="cantidad[]" class="form-control cantidad" placeholder="0" min="1">
                </td>
                <td class="columna_ventas total">-</td>
            `;

            tbody.appendChild(fila);
            activarEventos(fila); // activar eventos en la nueva fila
        }

        // Asignar eventos a una fila
        function activarEventos(fila) {
            const select = fila.querySelector('.producto_venta');
            const inputCantidad = fila.querySelector('.cantidad');

            select.addEventListener('change', function() {
                const productoId = this.value;
                if (productoId && precios[productoId] !== undefined) {
                    fila.querySelector('.precio_unidad').textContent = precios[productoId];
                } else {
                    fila.querySelector('.precio_unidad').textContent = '-';
                }
                calcularTotal(fila);

                // 🚀 Cuando seleccionas un producto en esta fila → crear otra fila
                if (!fila.dataset.usada) {
                    agregarFila();
                    fila.dataset.usada = true; // marcar que ya generó una nueva
                }
            });

            inputCantidad.addEventListener('input', function() {
                calcularTotal(fila);
            });
        }

        // 🔹 Evento para el input de pago del cliente
        document.getElementById('pago_cliente').addEventListener('input', calcularCambio);

        // Activar la primera fila
        activarEventos(document.querySelector('#body_ventas tr'));

        // 🚀 Nueva función: limpiar todo
        document.getElementById('btn_cancelar').addEventListener('click', function() {
            const tbody = document.getElementById('body_ventas');
            tbody.innerHTML = `
                <tr>
                    <td class="columna_ventas">
                        <select name="producto_venta[]" class="form-select producto_venta">
                            <option value="">---Selecciona un producto---</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="columna_ventas precio_unidad">-</td>
                    <td class="columna_ventas">
                        <input type="number" name="cantidad[]" class="form-control cantidad" placeholder="0" min="1">
                    </td>
                    <td class="columna_ventas total">-</td>
                </tr>
            `;

            // resetear gran total, pago y cambio
            document.getElementById('gran_total').textContent = '-';
            document.getElementById('pago_cliente').value = '';
            document.getElementById('cambio').textContent = '-';

            // volver a activar eventos en la fila inicial
            activarEventos(document.querySelector('#body_ventas tr'));
        });
    </script>
@endsection
