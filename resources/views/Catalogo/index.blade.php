@extends('layouts.app')

@section('titulo')
    Catalogo
@endsection

@section('contenido')

    {{-- TARJETAS DE PRODUCTOS --}}
<div class="max-w-5xl mx-auto px-4 py-9">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-4">
        @foreach ($productos as $producto) {{-- Recorre la coleccion de productos y genera una tarjeta para cada uno --}}
            <a href="{{ route('catalogo.producto', $producto->id) }}">
                <div class="bg-white shadow-md overflow-hidden">

                    <div class="relative aspect-square bg-gray-100">
                        @if ($producto->imagen_producto->isNotEmpty()) {{-- Verifica si el producto tiene imágenes --}}
                            <img
                                src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" {{-- Muestra la primera imagen del producto --}}
                                alt="{{ $producto->nombre_producto  }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <p class="p-4 text-gray-400">Sin imagen</p>
                        @endif
                    </div>

                    <div class="p-3">
                        <p class="text-sm font-medium text-gray-800 truncate">{{ $producto->nombre_producto }}</p>
                        <p class="text-sm font-bold text-gray-800">${{ number_format($producto->precio, 0, ',', '.') }}</p>
                    </div>

                </div>
            </a>
        @endforeach
    </div>
</div>

@endsection 