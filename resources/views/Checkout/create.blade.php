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
            <p class="text-sm text-gray-500 mb-6">Completa tus datos y revisa tu pedido antes de enviarlo por WhatsApp.</p>

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
                    <p class="mb-2 text-sm font-semibold text-gray-700">Ciudad</p>

                    <div class="flex flex-wrap gap-2">
                        @foreach ($ciudades as $ciudad)
                            <label>
                                <input type="radio" name="ciudad" value="{{ $ciudad }}" class="peer hidden" @checked(old('ciudad') == $ciudad)>
                                <span class="block cursor-pointer rounded-full border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-black peer-checked:border-black peer-checked:bg-black peer-checked:text-white">
                                    {{ $ciudad }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <input name="otra_ciudad" value="{{ old('otra_ciudad') }}" placeholder="¿Otra ciudad? Escríbela aquí"
                        class="mt-3 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">

                    <p class="mt-1 text-xs text-gray-500">
                        Si tu ciudad no aparece, escríbela y te confirmaremos el costo de envío por WhatsApp.
                    </p>
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

                <button type="submit" class="w-full bg-black text-white py-3 rounded font-bold hover:bg-gray-800 transition-colors">
                    Confirmar pedido
                </button>
            </div>
        </div>

    </form>

</div>

@endsection