@extends('layouts.app')

@section('titulo')
    Catalogo
@endsection

@section('contenido')

    {{-- TARJETAS DE PRODUCTOS --}}
<div class="max-w-8xl mx-auto pt-12 pb-12 px-24">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2">
        @foreach ($productos as $producto)
            <a href="{{ route('catalogo.producto', $producto->id) }}">
                <div class="transition-all duration-100 ease-in-out hover:scale-110 hover:shadow-xl hover:border hover:border-black">

                    <div class="aspect-square bg-gray-100">
                        @if ($producto->imagen_producto->isNotEmpty())
                            <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" alt="{{ $producto->nombre_producto }}" class="w-full h-full object-cover">
                        @else
                            <p class="p-4 text-gray-400">Sin imagen</p>
                        @endif
                    </div>

                    <div class="p-2 bg-white">
                        <p class="text-md font-semibold text-black">${{ number_format($producto->precio, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">{{ $producto->nombre_producto }}</p>
                        <p class="text-sm text-gray-400">{{ $producto->categoria->nombre_categoria }}</p>
                    </div>

                </div>
            </a>

            {{-- INTERRUPCIÓN DE LA CUADRÍCULA CON EL BANNER PUBLICITARIO --}}
            {{-- $loop->iteration cuenta el producto actual. Si es 8 (2 filas de 4), inserta el banner --}}
            @if ($loop->iteration == 8)
                <div class="col-span-1 sm:col-span-2 md:col-span-2 lg:col-span-full my-6">
                    <div class="w-full h-144 overflow-hidden relative shadow-md">
                        <img src="{{ asset('img/banner-gorras.png') }}" alt="Modelado de gorras" class="w-full h-full object-cover">
                    </div>
                </div>
            @endif

        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $productos->links() }}
    </div>
</div>

@endsection