@extends('layouts.app')

@section('titulo')
    Inicio | GhostCaps
@endsection

@section('contenido')

    {{-- BANNER PRINCIPAL --}}
    <section class="relative w-full overflow-hidden bg-black">

        <img
            src="{{ asset('img/banners/bannerbeta2.jpg') }}"
            alt="Colección GhostCaps"
            class="w-full h-auto block object-cover"
        >

        {{-- Oscurecido suave --}}
        <div class="absolute inset-0 bg-black/25"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center px-5 text-center">

        <h1 class="sr-only">GhostCaps</h1>

        @if (File::exists(public_path('img/logo-ghostcaps-banner.png')))
            <img
                src="{{ asset('img/logo-ghostcaps-banner.png') }}"
                alt="GhostCaps"
                class="w-[280px] sm:w-[420px] lg:w-[520px]"
            >
        @else
            <p class="text-white">Falta el logo: img/logo-ghostcaps-banner.png</p>
        @endif

            <p class="-mt-2 text-sm italic text-white sm:-mt-4 sm:text-lg">
                Vive en la cima.
            </p>

            <a
                href="{{ route('catalogo.index') }}"
                class="mt-6 border border-white/80 px-6 py-2.5 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-white hover:text-black sm:mt-7 sm:px-8 sm:py-3.5 sm:text-sm"
            >
                Explorar catálogo
            </a>

        </div>
    </section>

    {{-- CATEGORÍAS DESTACADAS --}}
    <section class="max-w-7xl mx-auto px-4 py-10">

        <h2 class="text-xl text-black mb-4 font-marker">Explora por categoría</h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach ($categoriasInicio as $categoria)
                <a href="{{ route('catalogo.index', ['categorias' => [$categoria['id']]]) }}">
                    <div class="relative aspect-square overflow-hidden bg-gray-100 transition-all duration-100 ease-in-out hover:scale-105">

                        @if ($categoria['imagen'])
                            <img src="{{ $categoria['imagen'] }}" alt="{{ $categoria['nombre'] }}" class="w-full h-full object-cover">
                        @else
                            <p class="p-4 text-gray-400">Sin imagen</p>
                        @endif

                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                            <p class="text-md font-semibold text-white">{{ $categoria['nombre'] }}</p>
                        @if ($categoria['descripcion'])
                            <p class="line-clamp-2 text-sm text-gray-200">{{ $categoria['descripcion'] }}</p>
                        @endif
                        </div>

                    </div>
                </a>
            @endforeach
        </div>

    </section>

    <section class="w-full py-10">
        <div class="relative w-full overflow-hidden shadow-md">

            @if (File::exists(public_path('img/banners/adidasbanner.jpg')))
                <img src="{{ asset('img/banners/adidasbanner.jpg') }}" alt="Colección destacada GhostCaps" class="w-full h-full object-cover">
            @else
                <p class="p-4 text-gray-400">Sin imagen</p>
            @endif

            <div class="absolute inset-0 bg-black/30 flex flex-col items-center justify-end pb-24 text-center text-white">
                <p class="text-base uppercase tracking-widest">Colección destacada</p>

                <h2 class="text-4xl font-bold">Gorras Adidas</h2>

                <a
                    href="{{ route('catalogo.index') }}"
                    class="mt-4 border border-white/80 px-6 py-2.5 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-white hover:text-black hover:scale-125"
                >
                    Ver colección
                </a>
            </div>

        </div>
    </section>

    {{-- BLOQUE EDITORIAL: COLECCIÓN ESPECIAL --}}
    <section class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">

        <div>
            @if (File::exists(public_path('img/banners/goorinbros2.jpg')))
                <img src="{{ asset('img/banners/goorinbros2.jpg') }}" alt="Gorras de diseños especiales" class="w-full h-auto">
            @else
                <p class="p-4 text-gray-400">Sin imagen</p>
            @endif
        </div>

        <div class="flex flex-col justify-center text-center md:text-left max-w-md mx-auto h-full">
            <p class="text-base uppercase tracking-[0.3em] text-gray-500">Diseños y personalidad</p>

            <h2 class="text-5xl sm:text-6xl font-black text-black mt-5 leading-tight">Gorras Goorin Bros</h2>

            <p class="mt-6 text-lg sm:text-xl text-gray-600 leading-8">
                Descubre diseños llamativos, estampados únicos y gorras que destacan por sus detalles.
            </p>

            <a
                href="{{ route('catalogo.index') }}"
                class="mt-10 inline-block border border-black px-8 py-3.5 text-sm font-bold uppercase tracking-widest text-black transition hover:bg-black hover:text-white"
            >
                Ver colección
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