@extends('layouts.app')

@section('titulo')
    {{ $producto->nombre_producto }}
@endsection

@section('contenido')

<div class="px-4 sm:px-8 pt-6">
    <a href="{{ route('catalogo.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 hover:text-black transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Volver al catálogo
    </a>
</div>

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
            @if ($producto->stock > 0)
                <p class="text-sm text-gray-500">{{ $producto->stock }} unidades disponibles</p>
            @else
                <p class="text-sm font-semibold text-red-600">Agotado</p>
            @endif
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

                @if ($producto->stock > 0)

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

                @else

                    <div class="rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        Este producto está agotado por el momento.
                    </div>

                    <button type="button" disabled class="w-full cursor-not-allowed rounded bg-gray-200 py-4 text-lg font-bold text-gray-400">
                        Comprar ahora
                    </button>

                    <button type="button" disabled class="w-full cursor-not-allowed rounded border border-gray-200 py-3 font-semibold text-gray-400">
                        Agregar al carrito
                    </button>

                @endif

            </div>
            
            {{-- BLOQUE DE CONFIANZA CON COLOR --}}
            <div class="mt-4 rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 space-y-3 shadow-xs">
                
                {{-- 1. Caja Rígida (Ámbar) --}}
                <div class="flex items-start gap-3.5 p-2 rounded-xl transition-colors hover:bg-amber-50/50">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-amber-500/10 text-amber-600 border border-amber-500/20 shadow-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </span>
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="font-bold text-gray-900 text-sm">Empaque en Caja Rígida</p>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 bg-amber-100/80 px-2 py-0.5 rounded-full">Protegido</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">Tu gorra viaja protegida contra aplastamientos en corona y visera.</p>
                    </div>
                </div>

                {{-- 2. Envíos Nacionales (Azul) --}}
                <div class="flex items-start gap-3.5 p-2 rounded-xl transition-colors hover:bg-blue-50/50 border-t border-gray-100 pt-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-500/10 text-blue-600 border border-blue-500/20 shadow-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                    </span>
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="font-bold text-gray-900 text-sm">Envíos a toda Colombia</p>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700 bg-blue-100/80 px-2 py-0.5 rounded-full">Nacional</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">Entrega en 2 a 4 días hábiles con guía de rastreo en tiempo real.</p>
                    </div>
                </div>

                {{-- 3. Garantía GhostCaps (Rojo de la marca) --}}
                <div class="flex items-start gap-3.5 p-2 rounded-xl transition-colors hover:bg-red-50/50 border-t border-gray-100 pt-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-600 border border-red-500/20 shadow-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </span>
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="font-bold text-gray-900 text-sm">Garantía GhostCaps</p>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-red-700 bg-red-100/80 px-2 py-0.5 rounded-full">30 Días</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">15 días para cambios y 30 días de respaldo por defectos de fábrica.</p>
                    </div>
                </div>

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