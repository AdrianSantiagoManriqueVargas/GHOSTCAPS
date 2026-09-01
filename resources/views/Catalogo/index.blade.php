@extends('layouts.app')

@section('titulo')
    Catalogo
@endsection

@section('contenido')
    
    <div class="">
        <h1>Catalogo</h1>
    </div>

    {{-- TARJETAS DE PRODUCTOS --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach ($productos as $producto) {{-- Recorre la coleccion de productos y genera una tarjeta para cada uno --}}
    <a href="{{ route('catalogo.producto', $producto->id) }}" class="">
        <div class="">

            <div class="">
                @if ($producto->imagen_producto->isNotEmpty()) {{-- Verifica si el producto tiene imágenes --}}
                    <img
                        src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" {{-- Muestra la primera imagen del producto --}}
                        alt="{{ $producto->nombre_producto  }}"
                        class=""
                    >
                @else
                    <p class="">Sin imagen</p>
                @endif
            </div>

            <div class="">
                <p class="">
                    {{ $producto->categoria->nombre_categoria }}
                </p>
                <h2 class="">
                    {{ $producto->nombre_producto }}
                </h2>
                <p class="">
                    {{ $producto->stock }} unidades disponibles
                </p>
                <p class="">
                    ${{ number_format($producto->precio, 0, ',', '.') }}
                </p>
            </div>
            
        </div>
    @endforeach
    </div>

    @section('volver')
        Volver
    @endsection

@endsection 