@extends('layouts/main')

@section('contenido')
    <h2>INVENTARIO</h2>

    <div class="container">
        <a href="{{ route('createinventario') }}" class="btn btn-primary d-inline-flex align-items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus-circle-fill" viewBox="0 0 16 16" role="img" aria-label="Agregar">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
            </svg>
            Agregar producto
        </a>
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unidad</th>
                    <th>Proveedor</th>
                    <th>Perecedero</th>
                    <th>Vencimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>{{ $item->preciounidad }}</td>
                        <td>{{ $item->proveedor }}</td>
                        <td>{{ $item->perecedero }}</td>
                        <td>
                            @if ($item->perecedero === 'Si')
                                {{ $item->fechavencimiento }}
                            @else
                                {{-- O deja el <td> vacío o con guion --}}
                                -
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('destroyinventario', $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('showinventario', $item->id) }}"
                                    class="btn btn-primary d-inline-flex align-items-center gap-1"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-list-task" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z" />
                                        <path
                                            d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z" />
                                        <path fill-rule="evenodd"
                                            d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z" />
                                    </svg>Mostrar</a>

                                <a href="{{ route('editinventario', $item->id) }}"
                                    class="btn btn-warning d-inline-flex align-items-center gap-1"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>Editar</a>

                                <button class="btn btn-danger d-inline-flex align-items-center gap-1" type="submit"
                                    onclick="return ConfirmarEliminacion()"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-trash3"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                    </svg>Borrar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No hay datos en la tabla..</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $items->links() }}
        </div>
    </div>

    <script>
        function ConfirmarEliminacion() {

            var respuesta = confirm("¿Seguro que deseas eliminar este producto?");
            if (respuesta == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
