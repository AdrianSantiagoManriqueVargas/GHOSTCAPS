@extends('layouts.gestion')

@section('titulo')
    Inicio
@endsection

@section('contenido')

{{-- ENCABEZADO --}}
<div class="flex items-start justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Todo bajo control.</h1>
        <p class="text-base text-gray-500 mt-1">Bienvenido a GhostCaps. Este es el resumen de tu tienda.</p>
    </div>
    <a href="{{ route('producto.create') }}"
       class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-5 py-3 rounded-lg transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Nuevo producto
    </a>
</div>

{{-- TARJETAS DE ESTADÍSTICAS --}}
<div class="grid grid-cols-4 gap-4 mb-6">

    {{-- Productos --}}
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-base font-medium text-gray-500">Productos</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <p class="text-4xl font-bold text-gray-900">{{ $totalProductos }}</p>
        <p class="text-sm text-gray-400 mt-2">En tu catálogo</p>
    </div>

    {{-- Categorías --}}
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-base font-medium text-gray-500">Categorías</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l7 7a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0l-7-7A1 1 0 014 11.586V7a4 4 0 014-4z"/>
            </svg>
        </div>
        <p class="text-4xl font-bold text-gray-900">{{ $totalCategorias }}</p>
        <p class="text-sm text-gray-400 mt-2">Para organizar tu colección</p>
    </div>

    {{-- Clientes --}}
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-base font-medium text-gray-500">Clientes</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5.13a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <p class="text-4xl font-bold text-gray-900">{{ $totalClientes }}</p>
        <p class="text-sm text-gray-400 mt-2">
            {{ $totalClientes === 0 ? 'Sin clientes registrados' : 'Clientes registrados' }}
        </p>
    </div>

    {{-- Pedidos --}}
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-base font-medium text-gray-500">Pedidos</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <p class="text-4xl font-bold text-gray-900">{{ $totalPedidos }}</p>
        <p class="text-sm text-gray-400 mt-2">
            {{ $totalPedidos === 0 ? 'Aún no hay pedidos' : 'Pedidos realizados' }}
        </p>
    </div>

</div>

{{-- GRID INFERIOR --}}
<div class="grid grid-cols-3 gap-4 mb-4">

    {{-- INVENTARIO BAJO --}}
    <div class="col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-6">

        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                <h2 class="text-base font-semibold text-gray-900">Inventario bajo</h2>
            </div>
            <span class="text-sm text-gray-400">2 unidades o menos</span>
        </div>

        @if ($productosStockBajo->isEmpty())
            <div class="py-8 text-center">
                <p class="text-sm text-gray-400">¡Todo el inventario está bien abastecido!</p>
            </div>
        @else
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left text-sm font-semibold uppercase tracking-wider text-gray-400 pb-3">Producto</th>
                        <th class="text-right text-sm font-semibold uppercase tracking-wider text-gray-400 pb-3">Precio</th>
                        <th class="text-right text-sm font-semibold uppercase tracking-wider text-gray-400 pb-3">Stock</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($productosStockBajo as $producto)
                        <tr>
                            <td class="py-3.5 flex items-center gap-3">
                                <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-100 shrink-0">
                                    @if ($producto->imagen_producto->isNotEmpty())
                                        <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}"
                                             alt="{{ $producto->nombre_producto }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 leading-tight">{{ $producto->nombre_producto }}</p>
                                    <p class="text-sm text-gray-400 mt-0.5">{{ $producto->categoria->nombre_categoria }}</p>
                                </div>
                            </td>
                            <td class="py-3.5 text-right text-sm text-gray-600">
                                ${{ number_format($producto->precio, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 text-right">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-bold
                                    {{ $producto->stock === 0 ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-600' }}">
                                    {{ $producto->stock }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 pt-3 border-t border-gray-50">
                <a href="{{ route('producto.index') }}"
                   class="inline-flex items-center gap-1 text-sm font-semibold text-red-500 hover:text-red-600 transition-colors">
                    Ver productos
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        @endif

    </div>

    {{-- ACCESOS RÁPIDOS --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">

        <h2 class="text-base font-semibold text-gray-900 mb-1">Accesos rápidos</h2>
        <p class="text-sm text-gray-400 mb-5">Lo esencial para gestionar tu catálogo.</p>

        <div class="space-y-1">

            <a href="{{ route('producto.create') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                <div class="w-9 h-9 rounded-full border border-red-200 bg-red-50 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Crear producto</p>
                    <p class="text-sm text-gray-400 truncate">Añade una nueva gorra a la tienda</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 group-hover:text-gray-500 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>

            <a href="{{ route('producto.index') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                <div class="w-9 h-9 rounded-full border border-gray-200 bg-gray-50 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Administrar productos</p>
                    <p class="text-sm text-gray-400 truncate">Edita precios, imágenes y existencias</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 group-hover:text-gray-500 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>

            <a href="{{ route('categoria.index') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                <div class="w-9 h-9 rounded-full border border-gray-200 bg-gray-50 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l7 7a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0l-7-7A1 1 0 014 11.586V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Gestionar categorías</p>
                    <p class="text-sm text-gray-400 truncate">Organiza las {{ $totalCategorias }} categorías del catálogo</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 group-hover:text-gray-500 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>

        </div>
    </div>

</div>

{{-- GRID INFERIOR 2 --}}
<div class="grid grid-cols-2 gap-4">

    {{-- ÚLTIMOS PEDIDOS --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">

        <div class="flex items-center justify-between mb-5">
            <h2 class="text-base font-semibold text-gray-900">Últimos pedidos</h2>
            <a href="#" class="inline-flex items-center gap-1 text-sm font-semibold text-red-500 hover:text-red-600 transition-colors">
                Ver pedidos
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @if ($ultimosPedidos->isEmpty())
            <div class="py-10 flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-700">Tu primer pedido está por llegar</p>
                <p class="text-sm text-gray-400 mt-1.5 max-w-xs leading-relaxed">Todavía no hay pedidos registrados. Cuando lleguen, podrás consultarlos y gestionarlos aquí.</p>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach ($ultimosPedidos as $pedido)
                    <div class="py-3.5 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $pedido->cliente->nombre_cliente }}</p>
                            <p class="text-sm text-gray-400">{{ $pedido->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">${{ number_format($pedido->total, 0, ',', '.') }}</p>
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                {{ $pedido->estado_pedido === 'Entregado' ? 'bg-green-100 text-green-700' :
                                  ($pedido->estado_pedido === 'Cancelado' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                {{ $pedido->estado_pedido }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    {{-- TUS CLIENTES --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-gray-900">Tus clientes</h2>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5.13a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>

        <p class="text-5xl font-bold text-gray-900 mb-1">{{ $totalClientes }}</p>
        <p class="text-base text-gray-500 mb-6">El comienzo de tu comunidad</p>

        @if ($totalClientes === 0)
            <p class="text-sm text-gray-400 leading-relaxed">Los clientes registrados aparecerán aquí.</p>
        @endif

        <div class="mt-6 pt-4 border-t border-gray-50">
            <a href="{{ route('cliente.index') }}"
               class="inline-flex items-center gap-1 text-sm font-semibold text-red-500 hover:text-red-600 transition-colors">
                Administrar clientes
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

    </div>

</div>

@endsection