@extends('layouts.app')

@section('titulo')
    Inicio | GhostCaps
@endsection

@section('contenido')

    {{-- BANNER PRINCIPAL --}}
    <section class="max-w-[1850px] mx-auto px-4 sm:px-8 pt-4 sm:pt-6">
        <div class="relative h-[50svh] min-h-[360px] max-h-[760px] overflow-hidden rounded-2xl bg-black sm:h-[70svh] sm:min-h-[420px]">

            <img
                src="{{ asset('img/banners/bannerbeta2.jpg') }}"
                alt="Colección GhostCaps"
                class="absolute inset-0 h-full w-full object-cover object-center"
            >

            {{-- Degradado: más oscuro abajo para que el texto se lea --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/40"></div>

            <div class="relative flex h-full flex-col items-center justify-center px-5 text-center">

                <h1 class="sr-only">GhostCaps</h1>

                @if (File::exists(public_path('img/logo-ghostcaps-banner.png')))
                    <img
                        src="{{ asset('img/logo-ghostcaps-banner.png') }}"
                        alt="GhostCaps"
                        class="w-[260px] drop-shadow-2xl sm:w-[400px] lg:w-[520px]"
                    >
                @else
                    <p class="text-white">Falta el logo: img/logo-ghostcaps-banner.png</p>
                @endif

                <p class="mt-4 text-xs uppercase tracking-[0.4em] text-gray-200 sm:text-sm">
                    Vive en la cima
                </p>

                <a
                    href="{{ route('catalogo.index') }}"
                    class="mt-8 rounded-full border border-white bg-white px-8 py-3 text-sm font-bold uppercase tracking-widest text-black transition hover:bg-black hover:text-white"
                >
                    Explorar catálogo
                </a>

            </div>

            <div class="absolute bottom-6 left-1/2 hidden -translate-x-1/2 animate-bounce text-2xl text-white/80 sm:block">↓</div>

        </div>
    </section>

    {{-- CATEGORÍAS DESTACADAS --}}
    <section class="max-w-[1500px] mx-auto px-4 sm:px-8 py-10">

        <h2 class="text-xl text-black mb-4 font-marker">Explora por categoría</h2>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            @foreach ($categoriasInicio as $categoria)
                <a
                    href="{{ route('catalogo.index', ['categorias' => [$categoria['id']]]) }}"
                    class="group relative block aspect-[4/5] overflow-hidden rounded-2xl bg-gray-100"
                >

                    @if ($categoria['imagen'])
                        <img
                            src="{{ $categoria['imagen'] }}"
                            alt="{{ $categoria['nombre'] }}"
                            class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105"
                        >
                    @else
                        <p class="flex h-full items-center justify-center text-gray-400">Sin imagen</p>
                    @endif

                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-3 pt-16 text-white sm:p-5 sm:pt-20">

                        <p class="font-marker text-lg leading-tight tracking-wide sm:text-2xl">
                            {{ $categoria['nombre'] }}
                        </p>

                        @if ($categoria['descripcion'])
                            <p class="mt-1 hidden line-clamp-2 text-sm text-gray-200 sm:block">
                                {{ $categoria['descripcion'] }}
                            </p>
                        @endif

                        <p class="mt-2 inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest sm:mt-3 sm:text-xs">
                            Ver colección
                            <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                        </p>

                    </div>
                </a>
            @endforeach
        </div>

    </section>

    <section class="max-w-[1500px] mx-auto px-4 sm:px-8 py-10">
        <div class="relative min-h-[420px] w-full overflow-hidden rounded-2xl shadow-md sm:min-h-0">

            @if (File::exists(public_path('img/banners/LOONEY-PC.webp')))
                <img src="{{ asset('img/banners/LOONEY-PC.webp') }}" alt="Colección destacada GhostCaps" class="absolute inset-0 h-full w-full object-cover object-center sm:static sm:h-auto">
            @else
                <p class="p-4 text-gray-400">Sin imagen</p>
            @endif

            <div class="absolute inset-0 flex flex-col items-start justify-end bg-gradient-to-t from-black/70 via-black/20 to-transparent p-5 text-left text-white sm:p-10 lg:p-14">
                <p class="text-xs uppercase tracking-[0.2em] sm:text-base lg:text-lg">Colección destacada</p>

                <h2 class="mt-2 text-2xl font-black sm:text-4xl lg:text-5xl">Gorras Looney Tunes</h2>

                <a
                    href="{{ route('catalogo.index', ['categorias' => [3]]) }}"
                    class="mt-4 rounded-full border border-white bg-white px-6 py-3 text-xs font-bold uppercase tracking-widest text-black transition hover:bg-black hover:text-white sm:mt-6 sm:px-8 sm:text-sm"
                >
                    Ver colección
                </a>
            </div>

        </div>
    </section>

    {{-- BLOQUE EDITORIAL: COLECCIÓN ESPECIAL --}}
    {{-- COLECCIONES --}}
    <section class="max-w-[1500px] mx-auto px-4 sm:px-8 py-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 overflow-hidden rounded-2xl">

            <a href="{{ route('catalogo.index', ['categorias' => [1]]) }}" class="group relative block aspect-[4/5] overflow-hidden bg-neutral-900">
                <img src="{{ asset('img/banners/MULTIMARCAS.webp') }}" alt="Multimarcas" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-5 pt-16 text-white">
                    <p class="text-xl font-extrabold uppercase tracking-wide">Multimarcas</p>
                    <p class="mt-2 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
                        Ver colección
                        <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                    </p>
                </div>
            </a>

            <a href="{{ route('catalogo.index', ['categorias' => [1]]) }}" class="group relative block aspect-[4/5] overflow-hidden bg-neutral-900">
                <img src="{{ asset('img/banners/LICENCIAS.webp') }}" alt="Licencias" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-5 pt-16 text-white">
                    <p class="text-xl font-extrabold uppercase tracking-wide">Licencias</p>
                    <p class="mt-2 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
                        Ver colección
                        <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                    </p>
                </div>
            </a>

            <a href="{{ route('catalogo.index', ['categorias' => [1]]) }}" class="group relative block aspect-[4/5] overflow-hidden bg-neutral-900">
                <img src="{{ asset('img/banners/ROCKINLIFE.webp') }}" alt="Rockin Life" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-5 pt-16 text-white">
                    <p class="text-xl font-extrabold uppercase tracking-wide">Rockin Life</p>
                    <p class="mt-2 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
                        Ver colección
                        <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                    </p>
                </div>
            </a>

            <a href="{{ route('catalogo.index', ['categorias' => [1]]) }}" class="group relative block aspect-[4/5] overflow-hidden bg-neutral-900">
                <img src="{{ asset('img/banners/jg.webp') }}" alt="JG" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-5 pt-16 text-white">
                    <p class="text-xl font-extrabold uppercase tracking-wide">JG</p>
                    <p class="mt-2 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
                        Ver colección
                        <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                    </p>
                </div>
            </a>

        </div>
    </section>

    {{-- PROPUESTA DE VALOR --}}
    <section class="bg-black text-white">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center">

            <div class="px-8 py-16 sm:px-16 lg:px-24 text-center md:text-left">
                <p class="text-base uppercase tracking-[0.3em] text-gray-400">Propuesta de valor</p>

                <h2 class="font-marker text-5xl sm:text-6xl lg:text-7xl leading-tight tracking-wide mt-4">
                    Que tu estilo llegue a la <span class="text-red-500">cima.</span>
                </h2>

                <p class="mt-6 text-lg sm:text-xl text-gray-200 leading-8 max-w-md mx-auto md:mx-0">
                    Creamos gorras pa' que te expreses y destaques donde sea, con estilo que marca la diferencia.
                </p>

                <p class="mt-4 text-lg sm:text-xl text-gray-400 leading-8 max-w-md mx-auto md:mx-0">
                    Nuestra misión: transformar tu look con gorras que hacen que tu estilo llegue a la cima.
                </p>
            </div>

            <div class="flex justify-center md:justify-end px-8 pb-12 sm:px-16 md:pb-0 lg:px-24">
                @if (File::exists(public_path('img/logo.png')))
                    <img src="{{ asset('img/logo.png') }}" alt="Modelo con gorra GhostCaps" class="w-64 sm:w-80 lg:w-96 h-auto">
                @else
                    <p class="p-4 text-gray-500">Sin imagen</p>
                @endif
            </div>

        </div>
    </section>

    @endsection