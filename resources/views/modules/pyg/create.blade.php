@extends('layouts/main')

@section('contenido')
    <h2 class="text-center mt-3 mb-4">AGREGAR PERDIDA</h2>

    <div class="container">
        <form action="{{ route('storeperdida') }}" method="POST" class="formularios">
            @csrf
            <table class="table table-striped table-bordered text-center" id="tabla_perdidas">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="body_perdidas">
                    <tr>
                        <td class="columna_perdidas">
                            <input type="text" name="descripcion[]" class="form-control descripcion" placeholder="Descripción" required>
                        </td>
                        <td class="columna_perdidas">
                            <input type="number" name="total[]" class="form-control total" placeholder="0" min="0" required>
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <td class="text-end"><strong>Gran Total:</strong></td>
                        <td class="bg-primary" id="gran_total"><strong>-</strong></td>
                    </tr>
                </tfoot>
            </table>

            <button type="submit" class="btn btn-primary">Agregar pérdida</button>
            <a href="{{ route('reportes') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script>
        // Función para calcular el gran total
        function calcularGranTotal() {
            let suma = 0;
            document.querySelectorAll('.total').forEach(input => {
                const valor = parseFloat(input.value) || 0;
                suma += valor;
            });
            document.getElementById('gran_total').textContent = suma > 0 ? suma : '-';
        }

        // Función para agregar una nueva fila
        function agregarFila() {
            const tbody = document.getElementById('body_perdidas');
            const fila = document.createElement('tr');

            fila.innerHTML = `
                <td>
                    <input type="text" name="descripcion[]" class="form-control descripcion" placeholder="Descripción">
                </td>
                <td>
                    <input type="number" name="total[]" class="form-control total" placeholder="0" min="0">
                </td>
            `;

            tbody.appendChild(fila);
            activarEventos(fila); // activa eventos en la nueva fila
        }

        // Activar eventos en una fila
        function activarEventos(fila) {
            const inputTotal = fila.querySelector('.total');

            inputTotal.addEventListener('input', function() {
                calcularGranTotal();

                // Si este input aún no ha generado una nueva fila y ya tiene un valor > 0
                if (!fila.dataset.usada && this.value > 0) {
                    agregarFila();
                    fila.dataset.usada = true;
                }
            });
        }

        // Activar la primera fila al cargar
        activarEventos(document.querySelector('#body_perdidas tr'));
    </script>
@endsection
