@extends('layouts.app')

@section('titulo')
    Producto
@endsection

@section('contenido')

    <div class="">
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
                        Color
                    </th>
                    <th class="">
                        Precio
                    </th>
                    <th class="">
                        Stock
                    </th>
                    <th class="">
                        Imagen
                    </th>
                    <th class="">
                        Acciones
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach ($productos as $producto)

                <tr class="">
                    <td class="">{{ $producto->id }}</td>
                    <td class="">{{ $producto->categoria->nombre_categoria }}</td>
                    <td class="">{{ $producto->nombre_producto }}</td>
                    <td class="">{{ $producto->descripcion_producto }}</td>
                    <td class="">{{ $producto->color }}</td>
                    <td class="">{{ $producto->precio }}</td>
                    <td class="">{{ $producto->stock }}</td>
                    <td class="">
                    @if ($producto->imagen_producto->isNotEmpty())
                        <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" width="50">
                    @else
                        Sin imagen
                    @endif
                    </td>
                    <td class="">
                        <a href="{{ route('producto.edit', $producto->id) }}" class="">Editar</a>
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