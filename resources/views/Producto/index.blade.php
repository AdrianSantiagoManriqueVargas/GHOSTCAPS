@extends('layouts.gestion')

@section('titulo')
    Producto
@endsection

@section('contenido')

    <div class="bg-white rounded-lg shadow-sm border overflow-x-auto">

        <div class="flex justify-between items-center p-5 border-b">
            <h2 class="text-xl font-bold text-gray-800">
                Listado de Productos
            </h2>
            <a href="{{ route('producto.create') }}" class="bg-black text-white text-sm px-4 py-2 rounded hover:bg-gray-800 transition-colors">
                Nuevo Producto
            </a>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Categoría</th>
                    <th class="p-3">Nombre Producto</th>
                    <th class="p-3">Descripción</th>
                    <th class="p-3">Color</th>
                    <th class="p-3">Precio</th>
                    <th class="p-3">Stock</th>
                    <th class="p-3">Imagen</th>
                    <th class="p-3">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach ($productos as $producto)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 text-gray-500">{{ $producto->id }}</td>
                        <td class="p-3 text-gray-600">{{ $producto->categoria->nombre_categoria }}</td>
                        <td class="p-3 font-medium text-gray-800">{{ $producto->nombre_producto }}</td>
                        <td class="p-3 text-gray-600 max-w-xs truncate">{{ $producto->descripcion_producto }}</td>
                        <td class="p-3">
                            <div class="flex gap-1">
                                @forelse ($producto->color_producto as $color)
                                    <span class="w-5 h-5 rounded-full border inline-block" style="background-color: {{ $color->codigo_hex }}" title="{{ $color->nombre_color }}"></span>
                                @empty
                                    <span class="text-gray-400">Sin color</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="p-3 text-gray-600">${{ number_format($producto->precio, 0, ',', '.') }}</td>
                        <td class="p-3 text-gray-600">{{ $producto->stock }}</td>
                        <td class="p-3">
                            @if ($producto->imagen_producto->isNotEmpty())
                                <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" class="w-12 h-12 object-cover rounded">
                            @else
                                <span class="text-gray-400">Sin imagen</span>
                            @endif
                        </td>
                        <td class="p-3 flex gap-3">
                            <a href="{{ route('producto.edit', $producto->id) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection