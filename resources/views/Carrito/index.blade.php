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

        @if ($errors->has('stock'))
            <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 p-4 text-sm text-red-800 flex items-start gap-3 shadow-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div class="flex-1">
                    <p class="font-bold text-red-900">Compra no procesada</p>
                    <p class="mt-0.5 text-red-700 leading-relaxed">{{ $errors->first('stock') }}</p>
                </div>
            </div>
        @endif

        @forelse ($items as $item)
            @php $producto = $item['producto']; @endphp

            <div class="relative flex gap-6 bg-gray-50 p-5 mb-4 rounded-xl">

                {{-- Eliminar --}}
                <form action="{{ route('carrito.destroy', $producto->id) }}" 
                      method="post" 
                      @submit.prevent="fetch($el.action, { method: 'POST', body: new FormData($el) }).then(() => window.location.replace('{{ route('carrito.index') }}'))"
                      class="absolute top-4 right-4 hover:scale-110">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-400 hover:text-red-500" title="Eliminar producto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>

                {{-- Imagen --}}
                <div class="w-48 h-48 bg-white rounded-lg overflow-hidden shrink-0">
                    @if ($producto->imagen_producto->isNotEmpty())
                        <img src="{{ asset('storage/' . $producto->imagen_producto->first()->url_imagen) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">Sin imagen</div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 flex flex-col justify-between pr-8">

                    <div>
                        <p class="font-semibold text-base text-black">{{ $producto->nombre_producto }}</p>
                        
                        {{-- Descripción recortada a una sola línea --}}
                        <p class="text-xs text-gray-500 line-clamp-1 mt-0.5" title="{{ $producto->descripcion_producto }}">
                            {{ $producto->descripcion_producto }}
                        </p>

                        <div class="flex gap-1.5 mt-2">
                            @foreach ($producto->color_producto as $color)
                                <span class="w-3.5 h-3.5 rounded-full border border-gray-300 inline-block" 
                                      style="background-color: {{ $color->codigo_hex }}" 
                                      title="{{ $color->nombre_color }}"></span>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-end justify-between mt-4">

                        {{-- Cantidad (con replace para no ensuciar el historial de navegación) --}}
                        <div class="flex items-center gap-2">
                            @if ($item['cantidad'] > 1)
                                <form action="{{ route('carrito.update', $producto->id) }}" 
                                      method="post"
                                      @submit.prevent="fetch($el.action, { method: 'POST', body: new FormData($el) }).then(() => window.location.replace('{{ route('carrito.index') }}'))">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="cantidad" value="{{ $item['cantidad'] - 1 }}">
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg bg-white text-sm font-semibold hover:bg-gray-100 transition-colors">-</button>
                                </form>
                            @endif

                            <span class="w-6 text-center font-semibold text-sm">{{ $item['cantidad'] }}</span>

                            <form action="{{ route('carrito.update', $producto->id) }}" 
                                  method="post"
                                  @submit.prevent="fetch($el.action, { method: 'POST', body: new FormData($el) }).then(() => window.location.replace('{{ route('carrito.index') }}'))">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="cantidad" value="{{ $item['cantidad'] + 1 }}">
                                <button type="submit" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg bg-white text-sm font-semibold hover:bg-gray-100 transition-colors">+</button>
                            </form>
                        </div>

                        <p class="font-bold text-lg text-black">${{ number_format($item['subtotal'], 0, ',', '.') }}</p>

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
            <div class="border border-gray-200 p-6 sticky top-24 rounded-2xl bg-white shadow-sm">

                <h2 class="text-xl font-bold mb-6">Resumen del pedido</h2>

                <div class="flex justify-between text-base text-gray-600 mb-3">
                    <span>{{ count($items) }} producto(s)</span>
                    <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between text-base text-gray-600 mb-3">
                    <span>Envío</span>
                    <span>${{ number_format($costoEnvio, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between font-bold text-xl border-t border-gray-200 mt-4 pt-4 text-black">
                    <span>Total</span>
                    <span>${{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('checkout.create') }}" class="mt-6 block w-full text-center bg-black text-white py-4 rounded-xl font-bold hover:bg-neutral-800 transition-colors shadow-md">
                    Finalizar compra
                </a>

            </div>
        </div>
    @endif

</div>

@endsection