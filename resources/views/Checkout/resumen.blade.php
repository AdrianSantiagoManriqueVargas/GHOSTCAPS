@extends('layouts.app')

@section('titulo')
    Resumen del pedido
@endsection

@section('contenido')

<div class="max-w-5xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-3 gap-10 pb-20">

    {{-- Columna izquierda: productos y datos --}}
    <div class="lg:col-span-2">

        <h1 class="text-2xl font-bold text-gray-900 mb-1">Revisa tu pedido</h1>
        <p class="text-sm text-gray-500 mb-6">
            Tu pedido está registrado, pero aún no está confirmado. Envíalo por WhatsApp para que lo confirmemos contigo.
        </p>

        {{-- Productos --}}
        <div class="bg-white border rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-bold mb-4">Productos</h2>

            <div class="flex flex-col gap-4">
                @foreach ($pedido->detalle_pedido as $detalle)
                    @php $imagen = $detalle->producto->imagen_producto->first(); @endphp
                    <div class="flex gap-3">
                        <div class="w-16 h-16 bg-gray-50 shrink-0 rounded overflow-hidden">
                            @if ($imagen)
                                <img src="{{ asset('storage/' . $imagen->url_imagen) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800">{{ $detalle->producto->nombre_producto }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $detalle->cantidad }} x ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                            </p>
                        </div>
                        <p class="text-sm font-semibold text-gray-800 whitespace-nowrap">
                            ${{ number_format($detalle->subtotal_detalle, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Datos del cliente --}}
        <div class="bg-white border rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-bold mb-4">Tus datos</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Nombre</p>
                    <p class="font-semibold">{{ $pedido->cliente->nombre_cliente }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Teléfono</p>
                    <p class="font-semibold">{{ $pedido->cliente->telefono_cliente }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Correo</p>
                    <p class="font-semibold">{{ $pedido->cliente->correo_cliente }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Documento</p>
                    <p class="font-semibold">{{ $pedido->cliente->tipo_documento }} {{ $pedido->cliente->numero_documento }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-gray-500">Dirección de envío</p>
                    <p class="font-semibold">{{ $pedido->cliente->direccion }}, {{ $pedido->cliente->ciudad }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Columna derecha: totales y botón --}}
    <div class="lg:col-span-1">
        <div class="border border-gray-200 p-6 sticky top-24 bg-white">

            <h2 class="text-xl font-bold mb-5">Total del pedido</h2>

            <div class="flex justify-between text-base text-gray-600 mb-3">
                <span>Subtotal</span>
                <span>${{ number_format($pedido->subtotal, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between text-base text-gray-600 mb-3">
                <span>Envío</span>
                <span>${{ number_format($pedido->costo_envio, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between font-bold text-xl border-t border-gray-200 mt-4 pt-4 mb-6">
                <span>Total</span>
                <span>${{ number_format($pedido->total, 0, ',', '.') }}</span>
            </div>

            <a href="{{ $linkWhatsapp }}" target="_blank" rel="noopener"
               class="w-full bg-[#1c9e4c] text-white py-3 px-4 rounded font-bold text-sm hover:bg-[#0e5829] transition-colors flex items-center justify-center gap-2 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-white shrink-0">
                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm0 1.67c4.56 0 8.26 3.71 8.26 8.26s-3.7 8.26-8.26 8.26c-1.52 0-3-.42-4.29-1.21l-.31-.18-3.12.82.83-3.04-.2-.31a8.2 8.2 0 01-1.26-4.36c0-4.56 3.71-8.26 8.26-8.26zm4.52 10.49c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.78.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31-.23.25-.86.84-.86 2.06 0 1.21.89 2.38 1.01 2.54.12.17 1.76 2.68 4.26 3.76.6.26 1.06.41 1.43.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.14-1.18-.06-.1-.23-.16-.48-.29z"/>
                </svg>
                <span>Enviar pedido por WhatsApp</span>
            </a>

            <a href="{{ route('catalogo.index') }}" class="block mt-4 text-center text-sm text-gray-500 hover:text-black underline">
                Seguir comprando
            </a>

        </div>
    </div>

</div>

@endsection