@extends('layouts.app')

@section('titulo')
    {{ $producto->nombre_producto }}
@endsection

@section('contenido')

<div class="">

    <div class="">
        @if ($producto->imagen_producto->isNotEmpty())
            <img
                src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}"
                alt="{{ $producto->nombre_producto }}"
                class="w-1/3"
            >
        @else
            <p class="">Sin imagen</p>
        @endif
    </div>

    <div class="">

        <h2 class="">Nombre: {{ $producto->nombre_producto }}</h2>
        <p class="">Descripción: {{ $producto->descripcion_producto }}</p>
        <p class="">Stock: {{ $producto->stock }} unidades disponibles</p>
        <p class="">Precio: ${{ number_format($producto->precio, 0, ',', '.') }}</p>
        <p class="">Categoría: {{ $producto->categoria->nombre_categoria }}</p>

        {{-- Variantes de color --}}

        <div class="">
            <p class="">Color:</p>

            <span class="">{{ $producto->color }} (actual)</span> {{-- Muestra el color actual del producto --}}

            @foreach ($variantesColor as $variante) {{-- Recorre la lista de las otras gorras iguales pero en otro color excluyendo a la actual con el $excluirId --}}
                <a href="{{ route('catalogo.producto', $variante->id) }}" class=""> {{--  --}}
                    {{ $variante->color }}
                </a>
            @endforeach
        </div>

        <form action="{{ route('carrito.store', $producto->id) }}" method="POST">
            @csrf
            <button type="submit" class="">Agregar al carrito</button>
        </form>

    </div>

</div>

    <div class="">
        <a href="{{ route('catalogo.index') }}" class="">
            Volver
        </a>
    </div>

@endsection