@extends('layouts.app')

@section('titulo')
    Finalizar Compra
@endsection

@section('contenido')

<div class="max-w-5xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-3 gap-10 pb-20">

    <form action="{{ route('checkout.store') }}" method="post" class="lg:col-span-3 grid grid-cols-1 lg:grid-cols-3 gap-10">
        @csrf

        {{-- Columna izquierda: datos del cliente --}}
        <div class="lg:col-span-2">

            <h2 class="text-2xl font-bold text-gray-900 mb-1">Datos para tu pedido</h2>
            <p class="text-sm text-gray-500 mb-6">Completa tus datos y te redirigiremos a WhatsApp para confirmar la compra.</p>

            @if($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-800 rounded p-4 mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white border rounded-lg shadow-sm p-6">

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-700">Nombre</label>
                    <input name="nombre_cliente" value="{{ old('nombre_cliente') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-700">Telefono</label>
                    <input name="telefono_cliente" value="{{ old('telefono_cliente') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-700">Correo</label>
                    <input name="correo_cliente" type="email" value="{{ old('correo_cliente') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block mb-1 text-sm font-semibold text-gray-700">Tipo de documento</label>
                        <select name="tipo_documento" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                            <option value="CC" @selected(old('tipo_documento') == 'CC')>CC</option>
                            <option value="TI" @selected(old('tipo_documento') == 'TI')>TI</option>
                            <option value="CE" @selected(old('tipo_documento') == 'CE')>CE</option>
                            <option value="PP" @selected(old('tipo_documento') == 'PP')>PP</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-semibold text-gray-700">Numero de documento</label>
                        <input name="numero_documento" value="{{ old('numero_documento') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-700">Direccion</label>
                    <input name="direccion" value="{{ old('direccion') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">Ciudad</label>
                    <input name="ciudad" value="{{ old('ciudad') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

            </div>

            <a href="{{ route('carrito.index') }}" class="inline-block mt-4 text-sm text-gray-500 hover:text-black underline">
                Volver al carrito
            </a>

        </div>

        {{-- Columna derecha: resumen del pedido --}}
        <div class="lg:col-span-1">
            <div class="border border-gray-200 p-6 sticky top-24 bg-white">

                <h2 class="text-xl font-bold mb-5">Tu pedido</h2>

                <div class="flex flex-col gap-4 mb-5 max-h-72 overflow-y-auto pr-1">
                    @foreach ($items as $item)
                        @php $producto = $item['producto']; @endphp
                        <div class="flex gap-3">
                            <div class="w-14 h-14 bg-gray-50 shrink-0 rounded overflow-hidden">
                                @if ($producto->imagen_producto->isNotEmpty())
                                    <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $producto->nombre_producto }}</p>
                                <p class="text-xs text-gray-500">Cantidad: {{ $item['cantidad'] }}</p>
                            </div>
                            <p class="text-sm font-semibold text-gray-800 whitespace-nowrap">${{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between text-base text-gray-600 mb-3 border-t pt-4">
                    <span>Subtotal</span>
                    <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between text-base text-gray-600 mb-3">
                    <span>Envío</span>
                    <span>${{ number_format($costoEnvio, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between font-bold text-xl border-t border-gray-200 mt-4 pt-4 mb-6">
                    <span>Total</span>
                    <span>${{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <button type="submit" class="w-full bg-[#1c9e4c] text-white py-2 rounded font-bold hover:bg-[#0e5829] transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-white">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm0 1.67c4.56 0 8.26 3.71 8.26 8.26s-3.7 8.26-8.26 8.26c-1.52 0-3-.42-4.29-1.21l-.31-.18-3.12.82.83-3.04-.2-.31a8.2 8.2 0 01-1.26-4.36c0-4.56 3.71-8.26 8.26-8.26zm4.52 10.49c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.12-.17.25-.64.81-.78.97-.14.17-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31-.23.25-.86.84-.86 2.06 0 1.21.89 2.38 1.01 2.54.12.17 1.76 2.68 4.26 3.76.6.26 1.06.41 1.43.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.14-1.18-.06-.1-.23-.16-.48-.29z"/>
                    </svg>
                    Enviar pedido por WhatsApp
                </button>

            </div>
        </div>

    </form>

</div>

@endsection