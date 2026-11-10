@extends('layouts.app')

@section('titulo')
    {{ $producto->nombre_producto }}
@endsection

@section('contenido')

<div class="flex flex-col md:flex-row">

    <div class="md:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-3xl">

            @if ($producto->imagen_producto->isNotEmpty())
                <div
                    x-data="{
                        actual: 0,
                        total: {{ $producto->imagen_producto->count() }},
                        inicioX: 0,
                        ir(i) { this.actual = Math.max(0, Math.min(this.total - 1, i)); }
                    }"
                    @keydown.left.window="ir(actual - 1)"
                    @keydown.right.window="ir(actual + 1)"
                >

                    {{-- Imagen principal --}}
                    <div
                        class="relative aspect-square overflow-hidden rounded-2xl bg-gray-100"
                        @touchstart="inicioX = $event.touches[0].clientX"
                        @touchend="let d = $event.changedTouches[0].clientX - inicioX; if (Math.abs(d) > 40) ir(actual + (d < 0 ? 1 : -1))"
                    >

                        {{-- Pista que se desliza --}}
                        <div
                            class="absolute inset-0 flex ease-[cubic-bezier(0.22,1,0.36,1)] transition-transform duration-700 motion-reduce:transition-none"
                            :style="`transform: translateX(-${actual * 100}%)`"
                        >
                            @foreach ($producto->imagen_producto as $imagen)
                                <div class="h-full w-full shrink-0 overflow-hidden">
                                    <img
                                        src="{{ asset('storage/' . $imagen->url_imagen) }}"
                                        alt="{{ $producto->nombre_producto }}"
                                        class="h-full w-full object-cover transition-transform duration-[1200ms] ease-out motion-reduce:transition-none"
                                        :class="actual === {{ $loop->index }} ? 'scale-100' : 'scale-125'"
                                    >
                                </div>
                            @endforeach
                        </div>

                        @if ($producto->imagen_producto->count() > 1)

                            {{-- Flechas --}}
                            <button type="button" @click="ir(actual - 1)" aria-label="Foto anterior"
                                class="absolute left-3 top-1/2 z-10 h-10 w-10 -translate-y-1/2 rounded-xl bg-white/80 text-2xl leading-none text-black transition hover:bg-white"
                                :class="actual === 0 ? 'pointer-events-none opacity-0' : ''">‹</button>

                            <button type="button" @click="ir(actual + 1)" aria-label="Foto siguiente"
                                class="absolute right-3 top-1/2 z-10 h-10 w-10 -translate-y-1/2 rounded-xl bg-white/80 text-2xl leading-none text-black transition hover:bg-white"
                                :class="actual === total - 1 ? 'pointer-events-none opacity-0' : ''">›</button>

                            {{-- Contador --}}
                            <span class="absolute bottom-3 right-3 z-10 rounded-full bg-black/60 px-3 py-1 text-xs font-bold text-white"
                                  x-text="`${actual + 1} / ${total}`"></span>

                        @endif

                    </div>

                    {{-- Miniaturas --}}
                    @if ($producto->imagen_producto->count() > 1)
                        <div class="mt-3 flex gap-2 overflow-x-auto">
                            @foreach ($producto->imagen_producto as $imagen)
                                <button
                                    type="button"
                                    @click="ir({{ $loop->index }})"
                                    class="h-16 w-16 shrink-0 overflow-hidden rounded-xl border-2 transition"
                                    :class="actual === {{ $loop->index }} ? 'border-black' : 'border-transparent opacity-60 hover:opacity-100'"
                                    aria-label="Ver foto {{ $loop->iteration }}"
                                >
                                    <img src="{{ asset('storage/' . $imagen->url_imagen) }}" alt="" class="h-full w-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif

                </div>
            @else
                <p class="w-full aspect-square bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400">Sin imagen</p>
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

@if ($relacionados->isNotEmpty())
    <section class="max-w-[1500px] mx-auto px-4 sm:px-8 py-10 border-t border-gray-200">

        <h2 class="text-xl text-black mb-4 font-marker">Productos que quizás te gusten</h2>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            @foreach ($relacionados as $relacionado)
                @php
                    $imagenRelacionado = $relacionado->imagen_producto->first();
                @endphp

                <a href="{{ route('catalogo.producto', $relacionado->id) }}"
                   class="group flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div class="aspect-square overflow-hidden bg-gray-100">
                        @if ($imagenRelacionado)
                            <img
                                src="{{ asset('storage/' . $imagenRelacionado->url_imagen) }}"
                                alt="{{ $relacionado->nombre_producto }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        @else
                            <p class="flex h-full items-center justify-center text-gray-400">Sin imagen</p>
                        @endif
                    </div>

                    <div class="flex flex-1 flex-col p-3 sm:p-4">

                        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 sm:text-xs">
                            {{ $relacionado->categoria->nombre_categoria }}
                        </p>

                        <p class="mt-1 line-clamp-1 text-sm font-semibold sm:text-base">
                            {{ $relacionado->nombre_producto }}
                        </p>

                        <p class="mt-1 text-base font-black sm:text-lg">
                            ${{ number_format($relacionado->precio, 0, ',', '.') }}
                        </p>

                        <span class="mt-3 inline-block rounded-full border border-black px-4 py-2 text-center text-[10px] font-bold uppercase tracking-widest transition group-hover:bg-black group-hover:text-white sm:text-xs">
                            Ver producto
                        </span>

                    </div>

                </a>
            @endforeach
        </div>

    </section>
@endif

@endsection