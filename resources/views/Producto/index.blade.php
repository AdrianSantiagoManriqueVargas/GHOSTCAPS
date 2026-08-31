@extends('layouts.app')

@section('titulo')
    Producto
@endsection

@section('contenido')

    <div class="container mx-auto mt-10">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-blue-800">
                    Listado de Productos
                </h2>
                <a href="{{ route('producto.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Nuevo Producto
                </a>
            </div>

        <table class="min-w-full border border-gray-300">
            <thead class="bg-blue-200">
                <tr>
                    <th class="border px-4 py-2">
                        ID
                    </th>
                    <th class="border px-4 py-2">
                        Categoria
                    </th>
                    <th class="border px-4 py-2">
                        Nombre Producto
                    </th>
                    <th class="border px-4 py-2">
                        Descripción
                    </th>
                    <th class="border px-4 py-2">
                        Color
                    </th>
                    <th class="border px-4 py-2">
                        Precio
                    </th>
                    <th class="border px-4 py-2">
                        Stock
                    </th>
                    <th class="border px-4 py-2">
                        Imagen
                    </th>
                    <th class="border px-4 py-2">
                        Acciones
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach ($productos as $producto)

                <tr class="text-center  hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $producto->id }}</td>
                    <td class="border px-4 py-2">{{ $producto->categoria->nombre_categoria }}</td>
                    <td class="border px-4 py-2">{{ $producto->nombre_producto }}</td>
                    <td class="border px-4 py-2">{{ $producto->descripcion_producto }}</td>
                    <td class="border px-4 py-2">{{ $producto->color }}</td>
                    <td class="border px-4 py-2">{{ $producto->precio }}</td>
                    <td class="border px-4 py-2">{{ $producto->stock }}</td>
                    <td class="border px-4 py-2">
                    @if ($producto->imagen_producto->isNotEmpty())
                        <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" width="50">
                    @else
                        Sin imagen
                    @endif
                    </td>
                    <td class="border px-4 py-2 flex justify-center">
                        <a href="{{ route('producto.edit', $producto->id) }}" class="bg-yellow-600 hover:bg-yellow-500 text-white px-4 py-2 rounded mr-8">Editar</a>
                        <form action="{{ route('producto.destroy', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-700 hover:bg-red-600 text-white px-4 py-2 rounded">
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