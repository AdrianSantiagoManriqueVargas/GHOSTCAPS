@extends('layouts.gestion')

@section('titulo')
    Gestión
@endsection

@section('contenido')

<div class="py-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Panel de gestión</h1>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-4xl mx-auto mb-10">

        <div class="bg-white rounded-lg p-5 shadow-sm border-l-4 border-blue-500 flex items-center gap-4">
            <div class="bg-blue-100 text-blue-600 rounded-full w-11 h-11 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $totalProductos }}</p>
                <p class="text-sm text-gray-500">Productos</p>
            </div>
        </div>

        <div class="bg-white rounded-lg p-5 shadow-sm border-l-4 border-violet-500 flex items-center gap-4">
            <div class="bg-violet-100 text-violet-600 rounded-full w-11 h-11 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l7 7a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0l-7-7A1 1 0 014 11.586V7a4 4 0 014-4z" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $totalCategorias }}</p>
                <p class="text-sm text-gray-500">Categorías</p>
            </div>
        </div>

        <div class="bg-white rounded-lg p-5 shadow-sm border-l-4 border-emerald-500 flex items-center gap-4">
            <div class="bg-emerald-100 text-emerald-600 rounded-full w-11 h-11 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 3a4 4 0 10-8 0" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $totalClientes }}</p>
                <p class="text-sm text-gray-500">Clientes</p>
            </div>
        </div>

        <div class="bg-white rounded-lg p-5 shadow-sm border-l-4 border-amber-500 flex items-center gap-4">
            <div class="bg-amber-100 text-amber-600 rounded-full w-11 h-11 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 2a1 1 0 00-1 1v1H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2V3a1 1 0 00-1-1H9zM9 11h6m-6 4h6" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $totalPedidos }}</p>
                <p class="text-sm text-gray-500">Pedidos</p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">

        <a href="{{ route('categoria.index') }}" class="bg-white border-t-4 border-violet-500 rounded-lg p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex items-center justify-between">
            <div>
                <p class="text-lg font-semibold text-gray-800">Categorías</p>
                <p class="text-sm text-gray-500 mt-1">Ver y administrar</p>
            </div>
            <span class="text-violet-500 text-xl">→</span>
        </a>

        <a href="{{ route('producto.index') }}" class="bg-white border-t-4 border-blue-500 rounded-lg p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex items-center justify-between">
            <div>
                <p class="text-lg font-semibold text-gray-800">Productos</p>
                <p class="text-sm text-gray-500 mt-1">Ver y administrar</p>
            </div>
            <span class="text-blue-500 text-xl">→</span>
        </a>

        <a href="{{ route('cliente.index') }}" class="bg-white border-t-4 border-emerald-500 rounded-lg p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex items-center justify-between">
            <div>
                <p class="text-lg font-semibold text-gray-800">Clientes</p>
                <p class="text-sm text-gray-500 mt-1">Ver y administrar</p>
            </div>
            <span class="text-emerald-500 text-xl">→</span>
        </a>

    </div>

</div>

@endsection