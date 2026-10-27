@extends('layouts.app')

@section('titulo')
    Catalogo
@endsection

@section('contenido')

<div class="max-w-8xl mx-auto pt-12 pb-12 px-24">

    {{-- FILTROS --}}
    <input type="checkbox" id="panel-filtros" class="peer hidden">

    {{-- Botón fijo debajo del navbar --}}
    <div class="sticky top-24 z-[5] mb-6 flex items-center gap-4 border-b border-gray-200 bg-white py-3">

        <label
            for="panel-filtros"
            class="inline-flex cursor-pointer items-center gap-3 rounded-full border border-black px-8 py-2.5 text-xs font-bold uppercase tracking-widest text-black transition hover:bg-black hover:text-white"
        >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                <path d="M4 6h9.8M18.2 6H20"/>
                <circle cx="16" cy="6" r="2.2"/>
                <path d="M4 12h1.8M10.2 12H20"/>
                <circle cx="8" cy="12" r="2.2"/>
                <path d="M4 18h7.8M16.2 18H20"/>
                <circle cx="14" cy="18" r="2.2"/>
            </svg>

            Filtros

            @if (!empty($filtros))
                <span class="h-2 w-2 rounded-full bg-red-600"></span>
            @endif
        </label>

        @if (!empty($filtros))
            <a href="{{ route('catalogo.index') }}" class="text-xs font-bold uppercase tracking-widest text-gray-500 transition hover:text-red-600">
                Limpiar filtros
            </a>
        @endif

    </div>

    {{-- Fondo oscuro: al hacer clic se cierra el panel --}}
    <label for="panel-filtros" class="fixed inset-0 z-40 hidden cursor-pointer bg-black/50 peer-checked:block"></label>

    {{-- Panel lateral --}}
    <aside class="fixed inset-y-0 left-0 z-50 w-80 max-w-full -translate-x-full overflow-y-auto bg-white p-6 shadow-xl transition-transform duration-300 peer-checked:translate-x-0">

        <div class="mb-6 flex items-center justify-between">
            <h2 class="font-marker text-2xl tracking-wide text-black">Filtros</h2>
            <label for="panel-filtros" class="cursor-pointer text-2xl leading-none text-gray-500 transition hover:text-red-600" aria-label="Cerrar filtros">✕</label>
        </div>

        <form action="{{ route('catalogo.index') }}" method="GET">

            {{-- Precio --}}
            <div class="border-t border-gray-200 py-5">
                <h3 class="text-sm font-bold uppercase tracking-widest text-black">Precio</h3>

                <div class="mt-3 flex items-center gap-3">
                    <input
                        type="number"
                        name="precio_min"
                        min="0"
                        value="{{ $filtros['precio_min'] ?? '' }}"
                        placeholder="Mínimo"
                        class="w-full border border-gray-300 px-3 py-2 text-sm"
                    >
                    <span class="text-gray-400">–</span>
                    <input
                        type="number"
                        name="precio_max"
                        min="0"
                        value="{{ $filtros['precio_max'] ?? '' }}"
                        placeholder="Máximo"
                        class="w-full border border-gray-300 px-3 py-2 text-sm"
                    >
                </div>
            </div>

            {{-- Color --}}
            @if ($colores->isNotEmpty())
                <div class="border-t border-gray-200 py-5">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-black">Color</h3>

                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($colores as $color)
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="colores[]"
                                    value="{{ $color->nombre_color }}"
                                    class="peer sr-only"
                                    @checked(in_array(strtolower($color->nombre_color), $coloresSeleccionados))
                                >

                                <div class="flex items-center gap-2 rounded-full border border-gray-300 px-3 py-1.5 text-sm text-gray-700 transition peer-checked:border-black peer-checked:bg-black peer-checked:text-white">
                                    <span
                                        class="h-4 w-4 rounded-full border border-gray-300"
                                        style="background-color: {{ $color->codigo_hex }}"
                                    ></span>
                                    {{ $color->nombre_color }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Aquí irán Categoría y Marca --}}

            <button
                type="submit"
                class="mt-2 w-full border border-black bg-black py-3 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-white hover:text-black"
            >
                Aplicar filtros
            </button>

            @if (!empty($filtros))
                <a href="{{ route('catalogo.index') }}" class="mt-4 block text-center text-xs font-bold uppercase tracking-widest text-gray-500 transition hover:text-red-600">
                    Limpiar filtros
                </a>
            @endif

        </form>

    </aside>

    {{-- TARJETAS DE PRODUCTOS --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2">
        @foreach ($productos as $producto)
            <a href="{{ route('catalogo.producto', $producto->id) }}" class="group block">

                <div class="aspect-square overflow-hidden bg-gray-100">
                    @if ($producto->imagen_producto->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}"
                            alt="{{ $producto->nombre_producto }}"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-110"
                        >
                    @else
                        <p class="p-4 text-gray-400">Sin imagen</p>
                    @endif
                </div>

                <div class="bg-white p-2">
                    <p class="text-md font-semibold text-black">${{ number_format($producto->precio, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600 transition-colors group-hover:text-black">{{ $producto->nombre_producto }}</p>
                    <p class="text-sm text-gray-400">{{ $producto->categoria->nombre_categoria }}</p>
                </div>

            </a>

            {{-- INTERRUPCIÓN DE LA CUADRÍCULA CON EL BANNER PUBLICITARIO --}}
            {{-- $loop->iteration cuenta el producto actual. Si es 8 (2 filas de 4), inserta el banner --}}
            @if ($loop->iteration == 8)
                <div class="col-span-1 sm:col-span-2 md:col-span-2 lg:col-span-full my-6">
                    <div class="w-full h-144 overflow-hidden relative shadow-md">
                        <img src="{{ asset('img/banners/banner-gorras.png') }}" alt="Modelado de gorras" class="w-full h-full object-cover">
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