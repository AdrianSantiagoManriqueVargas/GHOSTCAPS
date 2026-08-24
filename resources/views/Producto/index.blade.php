@extends('layouts.app')

@section('titulo')
    Producto
@endsection

@section('contenido')

    <div class="container">
        <div class="">
            <div class="">
                <h2 class="">
                    Listado de Productos
                </h2>
                <a href="{{ route('producto.create') }}" class="">
                    Nuevo Producto
                </a>
            </div>

        <table class="">
            <thead class="">
                <tr>
                    <th class="">
                        ID
                    </th>
                    <th class="">
                        Categoria
                    </th>
                    <th class="">
                        Nombre Producto
                    </th>
                    <th class="">
                        Descripción
                    </th>
                    <th class="">
                        Precio
                    </th>
                    <th class="">
                        Stock
                    </th>
                    <th class="">
                        Acciones
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach ($productos as $producto)

                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->categoria->nombre_categoria }}</td>
                    <td>{{ $producto->nombre_producto }}</td>
                    <td>{{ $producto->descripcion_producto }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>
                        <a href="{{ route('producto.edit', $producto->id) }}">Editar</a>
                        <form action="{{ route('producto.destroy', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

        </div>
    </div>

    @section('volver')
        Volver
    @endsection

@endsection