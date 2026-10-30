@extends('layouts.gestion')

@section('titulo')
    Productos
@endsection

@section('contenido')

{{-- ENCABEZADO --}}
<div class="flex items-start justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Productos</h1>
        <p class="text-base text-gray-500 mt-1">Administra tu catálogo de gorras, precios, stock y variantes.</p>
    </div>
    <a href="{{ route('producto.create') }}"
       class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-all shadow-sm shadow-red-600/20 hover:shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Nuevo producto
    </a>
</div>

{{-- CONTENEDOR DE LA TABLA --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    @if ($productos->isEmpty())
        <div class="py-20 text-center">
            <div class="w-16 h-16 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <p class="text-base font-semibold text-gray-900">No hay productos en el catálogo</p>
            <p class="text-sm text-gray-400 mt-1 max-w-md mx-auto leading-relaxed">Comienza agregando tu primera gorra para que aparezca en tu tienda.</p>
            <a href="{{ route('producto.create') }}"
               class="inline-flex items-center gap-2 mt-5 bg-black hover:bg-gray-800 text-white text-sm font-medium px-4 py-2 rounded-xl transition-colors">
                Crear producto
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/60">
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Producto</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Colores</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Precio</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Estado / Stock</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($productos as $producto)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            
                            {{-- Info Producto e Imagen --}}
                            <td class="py-4.5 px-7">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 shrink-0 border border-gray-100">
                                        @if ($producto->imagen_producto->isNotEmpty())
                                            <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}"
                                                 alt="{{ $producto->nombre_producto }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="text-base font-semibold text-gray-900 leading-snug">{{ $producto->nombre_producto }}</p>
                                            @if ($producto->destacado)
                                                <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 border border-amber-200/60 text-xs font-medium px-2 py-0.5 rounded-full">
                                                    ★ Destacado
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-500 mt-0.5">{{ $producto->categoria->nombre_categoria }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Colores --}}
                            <td class="py-4.5 px-7">
                                <div class="flex items-center gap-2 flex-wrap">
                                    @forelse ($producto->color_producto as $color)
                                        <span class="w-5 h-5 rounded-full border border-gray-200 shadow-2xs inline-block transition-transform hover:scale-125"
                                              style="background-color: {{ $color->codigo_hex }}"
                                              title="{{ $color->nombre_color }}"></span>
                                    @empty
                                        <span class="text-sm text-gray-400 italic">Sin color</span>
                                    @endforelse
                                </div>
                            </td>

                            {{-- Precio --}}
                            <td class="py-4.5 px-7 text-base font-medium text-gray-900">
                                ${{ number_format($producto->precio, 0, ',', '.') }}
                            </td>

                            {{-- Stock --}}
                            <td class="py-4.5 px-7">
                                @if ($producto->stock === 0)
                                    <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-200/50 text-sm font-medium px-3 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Agotado (0)
                                    </span>
                                @elseif ($producto->stock <= 2)
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200/50 text-sm font-medium px-3 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Bajo ({{ $producto->stock }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/50 text-sm font-medium px-3 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        {{ $producto->stock }} en stock
                                    </span>
                                @endif
                            </td>

                            {{-- Acciones --}}
                            <td class="py-4.5 px-7 text-right">
                                <div class="inline-flex items-center gap-1">
                                    
                                    {{-- Ver en tienda --}}
                                    <a href="{{ route('catalogo.producto', $producto->id) }}"
                                       target="_blank"
                                       title="Ver en la tienda"
                                       class="p-2 text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>

                                    {{-- Editar --}}
                                    <a href="{{ route('producto.edit', $producto->id) }}"
                                       title="Editar producto"
                                       class="p-2 text-gray-400 hover:text-black hover:bg-gray-100 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>

                                    {{-- Eliminar --}}
                                    <form action="{{ route('producto.destroy', $producto->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar la gorra \'{{ $producto->nombre_producto }}\'?')"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                title="Eliminar producto"
                                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="px-7 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $productos->links() }}
        </div>
    @endif

</div>

@endsection