@extends('layouts.gestion')

@section('titulo')
    Gestión
@endsection

@section('contenido')

<div class="py-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-8 text-center">Panel de gestión</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl mx-auto">

        <a href="{{ route('categoria.index') }}" class="bg-white border rounded-lg p-6 text-center shadow-sm hover:shadow-md hover:border-gray-400 transition-all">
            <p class="text-lg font-semibold text-gray-800">Categorías</p>
            <p class="text-sm text-gray-500 mt-1">Ver y administrar</p>
        </a>

        <a href="{{ route('producto.index') }}" class="bg-white border rounded-lg p-6 text-center shadow-sm hover:shadow-md hover:border-gray-400 transition-all">
            <p class="text-lg font-semibold text-gray-800">Productos</p>
            <p class="text-sm text-gray-500 mt-1">Ver y administrar</p>
        </a>

        <a href="{{ route('cliente.index') }}" class="bg-white border rounded-lg p-6 text-center shadow-sm hover:shadow-md hover:border-gray-400 transition-all">
            <p class="text-lg font-semibold text-gray-800">Clientes</p>
            <p class="text-sm text-gray-500 mt-1">Ver y administrar</p>
        </a>

    </div>
</div>

@endsection