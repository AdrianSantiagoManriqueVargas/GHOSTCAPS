@extends('layouts.app')

@section('titulo')
    Carrito
@endsection

@section('contenido')

<div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-3 gap-10 pb-32">

    {{-- Columna izquierda: lista de productos --}}
    <div class="lg:col-span-2">

        <h1 class="text-3xl font-bold mb-1">Tu carrito</h1>
        <p class="text-sm text-gray-500 mb-8">{{ count($items) }} producto(s)</p>

        @forelse ($items as $item)
            @php $producto = $item['producto']; @endphp

            <div class="relative flex gap-6 bg-gray-50 p-5 mb-4">

                {{-- Eliminar --}}
                <form action="{{ route('carrito.destroy', $producto->id) }}" method="post" class="absolute top-4 right-4 hover:scale-110">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-400 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>

                {{-- Imagen --}}
                <div class="w-48 h-48 bg-white">
                    @if ($producto->imagen_producto->isNotEmpty())
                        <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" class="w-full h-full object-cover">
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 flex flex-col justify-between pr-8">

                    <div>
                        <p class="font-semibold">{{ $producto->nombre_producto }}</p>
                        <p class="font-light text-gray-600">{{ $producto->descripcion_producto }}</p>
                        <p class="text-sm text-gray-400">Color: {{ $producto->color }}</p>
                    </div>

                    <div class="flex items-end justify-between mt-4">

                        {{-- Cantidad --}}
                        <div class="flex items-center gap-3">
                            @if ($item['cantidad'] > 1)
                                <form action="{{ route('carrito.update', $producto->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="cantidad" value="{{ $item['cantidad'] - 1 }}">
                                    <button type="submit" class="w-7 h-7 border border-gray-300 rounded bg-white hover:bg-gray-100">-</button>
                                </form>
                            @endif

                            <span class="w-6 text-center">{{ $item['cantidad'] }}</span>

                            <form action="{{ route('carrito.update', $producto->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="cantidad" value="{{ $item['cantidad'] + 1 }}">
                                <button type="submit" class="w-7 h-7 border border-gray-300 rounded bg-white hover:bg-gray-100">+</button>
                            </form>
                        </div>

                        <p class="font-semibold">${{ number_format($item['subtotal'], 0, ',', '.') }}</p>

                    </div>

                </div>

            </div>
        @empty
            <p class="text-gray-500 py-16">Tu carrito está vacío.</p>
        @endforelse

        <a href="{{ route('catalogo.index') }}" class="text-sm text-gray-500 hover:text-black underline">
            Volver al catálogo
        </a>

    </div>

    {{-- Columna derecha: resumen --}}
    @if (!empty($items))
        <div class="lg:col-span-1">
            <div class="border border-gray-200 p-6 sticky top-24">

                <h2 class="text-xl font-bold mb-6">Resumen del pedido</h2>

                <div class="flex justify-between text-base text-gray-600 mb-3">
                    <span>{{ count($items) }} producto(s)</span>
                    <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between text-base text-gray-600 mb-3">
                    <span>Envío</span>
                    <span>${{ number_format($costoEnvio, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between font-bold text-xl border-t border-gray-200 mt-4 pt-4">
                    <span>Total</span>
                    <span>${{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('checkout.create') }}" class="mt-6 block w-full text-center bg-black text-white py-4 rounded font-bold hover:bg-gray-800 transition-colors">
                    Finalizar compra
                </a>

            </div>
        </div>
    @endif

</div>

@endsection