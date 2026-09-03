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
                    <img src="{{ asset('storage/' . $item['producto']->imagen_producto->first()->url_imagen) }}" class="w-1/4">
                @endif

                <p class="">{{ $item['producto']->nombre_producto }}</p>
                <p class="">Cantidad: {{ $item['cantidad'] }}</p>
                <p class="">${{ number_format($item['producto']->precio, 0, ',', '.') }}</p>

                <form action="{{ route('carrito.destroy', $item['producto']->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="">Eliminar</button>
                </form>
            </div>
        @empty
            <p class="">Tu carrito está vacío.</p>
        @endforelse

    </div>

    <div class="">
        <a href="{{ route('catalogo.index') }}" class="">
            Volver
        </a>
    </div>

@endsection