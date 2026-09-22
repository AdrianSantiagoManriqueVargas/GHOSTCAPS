@extends('layouts.app')

@section('titulo')
    Catalogo
@endsection

@section('contenido')

    {{-- TARJETAS DE PRODUCTOS --}}
<div class="max-w-8xl mx-auto py-1 px-1">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-y-4">
        @foreach ($productos as $producto)
            <a href="{{ route('catalogo.producto', $producto->id) }}">
                <div class="bg-white border border-gray-200">

                    <div class="aspect-square bg-gray-100">
                        @if ($producto->imagen_producto->isNotEmpty())
                            <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" alt="{{ $producto->nombre_producto }}" class="w-full h-full object-cover">
                        @else
                            <p class="p-4 text-gray-400">Sin imagen</p>
                        @endif
                    </div>

                    <div class="bg-white p-3">
                        <p class="text-sm text-gray-800">{{ $producto->nombre_producto }}</p>
                        <p class="text-sm text-gray-800">${{ number_format($producto->precio, 0, ',', '.') }}</p>
                    </div>

                </div>
            </a>
        @endforeach
    </div>
</div>

@endsection 