@extends('layouts.gestion')

@section('titulo')
    Gestión
@endsection

@section('contenido')

<div class="min-h-screen flex items-center justify-center">
    <div class="">
        <h1 class="">Panel de gestión</h1>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('categoria.index') }}" class="">
                Gestión Categorías
            </a>
            <a href="{{ route('producto.index') }}" class="">
                Gestión Productos
            </a>
            <a href="{{ route('cliente.index') }}" class="">
                Gestión Clientes
            </a>
        </div>
    </div>
</div>

@endsection