@extends('layouts.gestion')

@section('titulo')
    Producto
@endsection

@section('contenido')

    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-bold text-gray-800">
            Listado de Productos
        </h2>
        <a href="{{ route('producto.create') }}" class="bg-black text-white text-sm px-4 py-2 rounded hover:bg-gray-800 transition-colors">
            Nuevo Producto
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($productos as $producto)
            <div class="bg-white rounded-lg shadow-sm border overflow-hidden flex flex-col">

                <div class="h-40 bg-gray-100 flex items-center justify-center">
                    @if ($producto->imagen_producto->isNotEmpty())
                        <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-400 text-sm">Sin imagen</span>
                    @endif
                </div>

                <div class="p-4 flex flex-col flex-1">
                    <p class="text-xs text-gray-500 uppercase">{{ $producto->categoria->nombre_categoria }}</p>
                    <h3 class="font-semibold text-gray-800 mb-1">{{ $producto->nombre_producto }}</h3>

                    <div class="flex gap-1 mb-2">
                        @forelse ($producto->color_producto as $color)
                            <span class="w-5 h-5 rounded-full border inline-block" style="background-color: {{ $color->codigo_hex }}" title="{{ $color->nombre_color }}"></span>
                        @empty
                            <span class="text-xs text-gray-400">Sin color</span>
                        @endforelse
                    </div>

                    <div class="flex justify-between text-sm text-gray-600 mb-4">
                        <span>${{ number_format($producto->precio, 0, ',', '.') }}</span>
                        <span>Stock: {{ $producto->stock }}</span>
                    </div>

                    <div class="mt-auto flex gap-2">
                        <a href="{{ route('producto.edit', $producto->id) }}" class="flex-1 text-center bg-blue-50 text-blue-700 text-sm font-semibold px-3 py-2 rounded hover:bg-blue-100 transition-colors">
                            Editar
                        </a>
                        <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-50 text-red-700 text-sm font-semibold px-3 py-2 rounded hover:bg-red-100 transition-colors">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $productos->links() }}
    </div>

@endsection 