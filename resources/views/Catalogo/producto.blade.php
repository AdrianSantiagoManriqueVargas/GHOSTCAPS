@extends('layouts.app')

@section('titulo')
    {{ $producto->nombre_producto }}
@endsection

@section('contenido')

<div class="flex flex-col md:flex-row">

    <div class="md:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-3xl">
            @if ($imagenActual)
            <div class="relative aspect-square overflow-hidden">
                <img
                    src="{{ asset('storage/' . $imagenActual->url_imagen) }}"
                    alt="{{ $producto->nombre_producto }}"
                    class="w-full h-full object-cover"
                >

                @if ($tieneAnterior)
                    <a href="{{ route('catalogo.producto', $producto->id) }}?img={{ $indiceActual - 1 }}" class="absolute left-2 top-1/2 -translate-y-1/2 text-3xl">‹</a>
                @endif

                @if ($tieneSiguiente)
                    <a href="{{ route('catalogo.producto', $producto->id) }}?img={{ $indiceActual + 1 }}" class="absolute right-2 top-1/2 -translate-y-1/2 text-3xl">›</a>
                @endif
            </div>
            @else
                <p class="w-full aspect-square bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">Sin imagen</p>
            @endif
        </div>
    </div>

    <div class="md:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md flex flex-col gap-4">

            <h2 class="text-4xl font-bold">{{ $producto->nombre_producto }}</h2>
            <p class="text-2xl font-semibold">Precio: ${{ number_format($producto->precio, 0, ',', '.') }}</p>
            <p class="text-gray-600 leading-relaxed">{{ $producto->descripcion_producto }}</p>
            <p class="text-sm text-gray-500">{{ $producto->stock }} unidades disponibles</p>
            <p class="text-sm text-gray-500">Categoría: {{ $producto->categoria->nombre_categoria }}</p>

            {{-- Variantes de color --}}

            @php
                $colorPrincipal = $producto->color_producto->first();
                $colorSecundario = $producto->color_producto->get(1);
            @endphp

            <div class="mt-2">

                <p class="text-sm font-semibold mb-2">Color: <span class="font-normal text-gray-600">{{ $colorPrincipal?->nombre_color }}</span></p>

                <div class="flex flex-wrap gap-3">
                    <span class="relative w-10 h-10 rounded-full ring-2 ring-offset-2 ring-black block" style="background-color: {{ $colorPrincipal?->codigo_hex }}">
                        @if ($colorSecundario)
                            <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-white" style="background-color: {{ $colorSecundario->codigo_hex }}"></span>
                        @endif
                    </span>

                    @foreach ($variantesColor as $variante)
                        @php
                            $varPrincipal = $variante->color_producto->first();
                            $varSecundario = $variante->color_producto->get(1);
                        @endphp
                        <a href="{{ route('catalogo.producto', $variante->id) }}"
                        title="{{ $varPrincipal?->nombre_color }}{{ $varSecundario ? ' / ' . $varSecundario->nombre_color : '' }}">
                            <span class="relative w-10 h-10 rounded-full border border-gray-200 opacity-80 hover:opacity-100 transition-opacity block" style="background-color: {{ $varPrincipal?->codigo_hex }}">
                                @if ($varSecundario)
                                    <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-white" style="background-color: {{ $varSecundario->codigo_hex }}"></span>
                                @endif
                            </span>
                        </a>
                    @endforeach
                </div>

            </div>
            {{-- Botones comprar ahora o agregar al carrito --}}

            <div class="mt-4 flex flex-col gap-3">
                
                <form action="{{ route('carrito.comprarAhora', $producto->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-black text-white py-4 rounded font-bold text-lg hover:bg-gray-800 transition-colors">
                        Comprar ahora
                    </button>
                </form>

                <form action="{{ route('carrito.store', $producto->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full border border-black text-black py-3 rounded font-semibold hover:bg-gray-100 transition-colors">
                        Agregar al carrito
                    </button>
                </form>

            </div>

        </div>
    </div>

</div>

@endsection