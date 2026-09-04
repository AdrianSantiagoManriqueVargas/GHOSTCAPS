@extends('layouts.app')

@section('titulo')
    Carrito
@endsection

@section('contenido')

    <div class="">

        <h1 class="">Carrito</h1>

        @forelse ($items as $item)
            <div class="">
                @if ($item['producto']->imagen_producto->isNotEmpty())
                    <img src="{{ asset('storage/' . $item['producto']->imagen_producto->first()->url_imagen) }}" class="w-1/5">
                @endif

                <p class="">{{ $item['producto']->nombre_producto }}</p>
                <p class="">Cantidad: {{ $item['cantidad'] }}</p>
                <p class="">${{ number_format($item['producto']->precio, 0, ',', '.') }}</p>
                <p class="">Subtotal: ${{ number_format($item['subtotal'], 0, ',', '.') }}</p>

                {{-- Boton menos solo se muestra si la cantidad es mayor a 1 --}}
                @if ($item['cantidad'] > 1)
                    <form action="{{ route('carrito.update', $item['producto']->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="cantidad" value="{{ $item['cantidad'] - 1 }}">
                        <button type="submit" class="">-</button>
                    </form>
                @endif

                <span class="">{{ $item['cantidad'] }}</span>

                <form action="{{ route('carrito.update', $item['producto']->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="cantidad" value="{{ $item['cantidad'] + 1 }}">
                    <button type="submit" class="">+</button>
                </form>

                <form action="{{ route('carrito.destroy', $item['producto']->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="">Eliminar</button>
                </form>
            </div>
            @empty
            <p class="">Tu carrito está vacío.</p>
        @endforelse

        @forelse ($items as $item)
            @empty
                <p class="">Tu carrito está vacío.</p>
        @endforelse

            <h3 class="">Total: ${{ number_format($total, 0, ',', '.') }}</h3>

    </div>

    <div class="">
        <a href="{{ route('catalogo.index') }}" class="">
            Volver
        </a>
    </div>

@endsection