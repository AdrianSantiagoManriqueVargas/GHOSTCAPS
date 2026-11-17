@extends('layouts.gestion')

@section('titulo')
    Pedidos
@endsection

@section('contenido')

{{-- ENCABEZADO --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Pedidos</h1>
    <p class="text-base text-gray-500 mt-1">Revisa los pedidos que llegan por WhatsApp y actualiza su estado.</p>
</div>

{{-- PESTAÑAS Y BUSCADOR (Sin bloques @php) --}}
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">

    {{-- Tabs de Estado --}}
    <div class="flex flex-wrap gap-2">
        @foreach ($tabs as $tab)
            <a href="{{ route('pedido.index', array_filter(['estado' => $tab['valor'], 'buscar' => $buscar])) }}"
               class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-sm font-medium transition-colors
                      {{ $estado === $tab['valor'] ? 'bg-black text-white border-black' : 'bg-white text-gray-600 border-gray-200 hover:border-gray-400' }}">
                {{ $tab['etiqueta'] }}
                <span class="text-xs {{ $estado === $tab['valor'] ? 'text-gray-300' : 'text-gray-400' }}">{{ $tab['cantidad'] }}</span>
            </a>
        @endforeach
    </div>

    {{-- Buscador rápido de Pedidos --}}
    <form action="{{ route('pedido.index') }}" method="GET" class="flex items-center gap-2 w-full lg:w-80">
        @if ($estado)
            <input type="hidden" name="estado" value="{{ $estado }}">
        @endif
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" 
                   name="buscar" 
                   value="{{ $buscar ?? '' }}" 
                   placeholder="Buscar por # pedido, cliente, tel..." 
                   class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black shadow-xs">
        </div>
        @if (!empty($buscar))
            <a href="{{ route('pedido.index', array_filter(['estado' => $estado])) }}" 
               title="Limpiar búsqueda" 
               class="px-3 py-2 text-xs font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                Limpiar
            </a>
        @endif
    </form>

</div>

{{-- CONTENEDOR DE LA TABLA --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    @if ($pedidos->isEmpty())
        <div class="py-20 text-center">
            <div class="w-16 h-16 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            @if ($estado)
                <p class="text-base font-semibold text-gray-900">No hay pedidos {{ strtolower($estado) }}s</p>
                <p class="text-sm text-gray-400 mt-1">Prueba con otro filtro.</p>
            @else
                <p class="text-base font-semibold text-gray-900">Aún no hay pedidos</p>
                <p class="text-sm text-gray-400 mt-1 max-w-md mx-auto leading-relaxed">Cuando un cliente confirme una compra, aparecerá aquí.</p>
            @endif
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/60">
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400"># Pedido</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Cliente</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Fecha</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Total</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Estado</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400 text-right">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($pedidos as $pedido)
                        <tr class="hover:bg-gray-50/50 transition-colors">

                            <td class="py-4 px-7 text-base font-semibold text-gray-900">
                                #{{ $pedido->id }}
                            </td>

                            <td class="py-4 px-7">
                                <p class="text-base font-semibold text-gray-900 leading-snug">{{ $pedido->cliente->nombre_cliente }}</p>
                                <p class="text-sm text-gray-500 mt-0.5">{{ $pedido->cliente->ciudad }}</p>
                            </td>

                            <td class="py-4 px-7 text-sm text-gray-600 whitespace-nowrap">
                                {{ $pedido->created_at->format('d/m/Y') }}
                                <span class="block text-xs text-gray-400">{{ $pedido->created_at->format('h:i A') }}</span>
                            </td>

                            <td class="py-4 px-7 text-base font-medium text-gray-900 whitespace-nowrap">
                                ${{ number_format($pedido->total, 0, ',', '.') }}
                            </td>

                            <td class="py-4 px-7">
                                @include('Pedido._badge', ['estado' => $pedido->estado_pedido])
                            </td>

                            <td class="py-4 px-7 text-right">
                                <a href="{{ route('pedido.show', $pedido->id) }}"
                                   class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-700 border border-gray-200 hover:border-black hover:bg-black hover:text-white px-4 py-2 rounded-xl transition-colors">
                                    Ver
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="px-7 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $pedidos->withQueryString()->links() }}
        </div>
    @endif

</div>

@endsection