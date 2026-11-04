@extends('layouts.gestion')

@section('titulo')
    Pedido #{{ $pedido->id }}
@endsection

@section('contenido')

{{-- VOLVER --}}
<a href="{{ route('pedido.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-black mb-6 transition-colors">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    Volver a pedidos
</a>

{{-- ENCABEZADO --}}
<div class="flex flex-wrap items-center gap-4 mb-8">
    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Pedido #{{ $pedido->id }}</h1>
    @include('Pedido._badge', ['estado' => $pedido->estado_pedido])
    <p class="text-sm text-gray-500">{{ $pedido->created_at->format('d/m/Y h:i A') }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- COLUMNA IZQUIERDA: PRODUCTOS --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            <div class="px-7 py-5 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">Productos</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/60">
                            <th class="py-3 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Producto</th>
                            <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Precio</th>
                            <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-400 text-center">Cant.</th>
                            <th class="py-3 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($pedido->detalle_pedido as $detalle)
                            @php $imagen = $detalle->producto?->imagen_producto->first(); @endphp
                            <tr>
                                <td class="py-4 px-7">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-100 shrink-0 border border-gray-100">
                                            @if ($imagen)
                                                <img src="{{ asset('storage/' . $imagen->url_imagen) }}"
                                                     alt="{{ $detalle->producto->nombre_producto }}"
                                                     class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-base font-semibold text-gray-900 leading-snug">
                                                {{ $detalle->producto?->nombre_producto ?? 'Producto eliminado' }}
                                            </p>
                                            <p class="text-sm text-gray-500 mt-0.5">
                                                {{ $detalle->producto?->categoria?->nombre_categoria }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-700 whitespace-nowrap">
                                    ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-700 text-center">
                                    {{ $detalle->cantidad }}
                                </td>
                                <td class="py-4 px-7 text-base font-semibold text-gray-900 text-right whitespace-nowrap">
                                    ${{ number_format($detalle->subtotal_detalle, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- COLUMNA DERECHA --}}
    <div class="flex flex-col gap-6">

        {{-- CLIENTE --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Cliente</h2>

            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-gray-400">Nombre</p>
                    <p class="font-semibold text-gray-900">{{ $pedido->cliente->nombre_cliente }}</p>
                </div>
                <div>
                    <p class="text-gray-400">Documento</p>
                    <p class="font-semibold text-gray-900">{{ $pedido->cliente->tipo_documento }} {{ $pedido->cliente->numero_documento }}</p>
                </div>
                <div>
                    <p class="text-gray-400">Teléfono</p>
                    <a href="https://wa.me/{{ $pedido->cliente->telefono_whatsapp }}" target="_blank" rel="noopener"
                       class="font-semibold text-emerald-700 hover:underline">
                        {{ $pedido->cliente->telefono_cliente }}
                    </a>
                </div>
                <div>
                    <p class="text-gray-400">Dirección</p>
                    <p class="font-semibold text-gray-900">{{ $pedido->cliente->direccion }}</p>
                </div>
                <div>
                    <p class="text-gray-400">Ciudad</p>
                    <p class="font-semibold text-gray-900">{{ $pedido->cliente->ciudad }}</p>
                </div>
            </div>

            <a href="https://wa.me/{{ $pedido->cliente->telefono_whatsapp }}?text={{ rawurlencode('Hola ' . $pedido->cliente->nombre_cliente . ', te escribimos de GhostCaps sobre tu pedido #' . $pedido->id . '.') }}"
               target="_blank" rel="noopener"
               class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-[#1c9e4c] hover:bg-[#0e5829] text-white text-sm font-medium py-2.5 transition-colors">
                Escribir al cliente por WhatsApp
            </a>
        </div>

        {{-- RESUMEN DE PAGO --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Resumen de pago</h2>

            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>Subtotal</span>
                <span>${{ number_format($pedido->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>Envío</span>
                <span>${{ number_format($pedido->costo_envio, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-lg font-bold text-gray-900 border-t border-gray-100 mt-3 pt-3">
                <span>Total</span>
                <span>${{ number_format($pedido->total, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- CAMBIAR ESTADO --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Estado del pedido</h2>

            <form action="{{ route('pedido.updateEstado', $pedido->id) }}" method="POST" class="flex flex-col gap-3">
                @csrf
                @method('PATCH')

                <select name="estado_pedido" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    @foreach (['Pendiente', 'Entregado', 'Cancelado'] as $opcion)
                        <option value="{{ $opcion }}" @selected($pedido->estado_pedido === $opcion)>{{ $opcion }}</option>
                    @endforeach
                </select>

                <button type="submit" class="w-full rounded-xl bg-black hover:bg-gray-800 text-white text-sm font-medium py-2.5 transition-colors">
                    Actualizar estado
                </button>
            </form>
        </div>

        {{-- MENSAJE ORIGINAL --}}
        <details class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <summary class="cursor-pointer text-sm font-semibold text-gray-700">Mensaje original del pedido</summary>
            <pre class="mt-4 whitespace-pre-wrap text-xs text-gray-600 font-sans leading-relaxed">{{ $pedido->mensaje_whatsapp }}</pre>
        </details>

    </div>

</div>

@endsection