@extends('layouts.app')

@section('titulo')
    {{ $producto->nombre_producto }}
@endsection

@section('contenido')

<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="flex flex-col md:flex-row gap-8">
        
    <div class="md:w-1/2">
        @if ($producto->imagen_producto->isNotEmpty())
        <div class="bg-gray-100 aspect-square overflow-hidden">
            <img
                src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}"
                alt="{{ $producto->nombre_producto }}"
                class="w-full h-full object-cover"
            >
        </div>
        @else
            <p class="w-full aspect-square bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">Sin imagen</p>
        @endif
    </div>

        <div class="md:w-1/2 flex flex-col gap-3">

            <h2 class="text-3xl font-bold">{{ $producto->nombre_producto }}</h2>
            <p class="text-2xl font-semibold">Precio: ${{ number_format($producto->precio, 0, ',', '.') }}</p>
            <p class="text-gray-600 leading-relaxed">{{ $producto->descripcion_producto }}</p>
            <p class="text-sm text-gray-500">{{ $producto->stock }} unidades disponibles</p>
            <p class="text-sm text-gray-500">Categoría: {{ $producto->categoria->nombre_categoria }}</p>

        {{-- Variantes de color --}}

        <div class="mt-2">

            <p class="text-sm font-semibold mb-2">Color:</p>

            <div class="flex flex-wrap gap-2">
                <span class="{{ $producto->colorClases() }} rounded px-4 py-2 text-sm font-medium">
                    {{ $producto->color }}
                </span>

                @foreach ($variantesColor as $variante)
                    <a href="{{ route('catalogo.producto', $variante->id) }}" class="{{ $variante->colorClases() }} rounded px-4 py-2 text-sm font-medium opacity-70 hover:opacity-100 transition-opacity">
                        {{ $variante->color }}
                    </a>
                @endforeach
            </div>
        </div>

            <form action="{{ route('carrito.store', $producto->id) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="w-full bg-black text-white py-3 rounded font-semibold hover:bg-gray-800 transition-colors">Agregar al carrito</button>
            </form>

        </div>

    </div>

</div>

@endsection