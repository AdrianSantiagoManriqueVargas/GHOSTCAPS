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
    @foreach ($productos as $producto)
        <div class="">
            <div class="">
                @if ($producto->imagen_producto->isNotEmpty())
                    <img
                        src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}"
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