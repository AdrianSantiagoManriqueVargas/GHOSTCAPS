@extends('layouts.gestion')

@section('titulo')
    Crear Categoría
@endsection

@section('contenido')

{{-- NAVEGACIÓN Y ENCABEZADO --}}
<div class="mb-8 max-w-2xl mx-auto">
    <a href="{{ route('categoria.index') }}" 
       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition-colors mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Volver a categorías
    </a>
    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Nueva categoría</h1>
    <p class="text-base text-gray-500 mt-1">Crea una nueva clasificación para organizar tus gorras en la tienda.</p>
</div>

{{-- ALERTAS DE ERROR --}}
@if ($errors->any())
    <div class="max-w-2xl mx-auto mb-6 p-4 rounded-2xl bg-red-50 border border-red-200/70 text-red-800 text-sm">
        <div class="flex items-center gap-2 font-semibold mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            Por favor corrige los siguientes errores:
        </div>
        <ul class="list-disc list-inside text-xs text-red-700 space-y-0.5 ml-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- TARJETA DEL FORMULARIO --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 max-w-2xl mx-auto">

    <form action="{{ route('categoria.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Nombre --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nombre de la categoría</label>
            <input type="text"
                   name="nombre_categoria"
                   value="{{ old('nombre_categoria') }}"
                   placeholder="Ej: Planas, Streetwear, Beanie..."
                   class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('nombre_categoria') border-red-500 @enderror">
            @error('nombre_categoria')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Descripción (opcional)</label>
            <textarea name="descripcion_categoria"
                      rows="3"
                      placeholder="Breve detalle sobre este estilo o colección..."
                      class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all resize-y @error('descripcion_categoria') border-red-500 @enderror">{{ old('descripcion_categoria') }}</textarea>
            @error('descripcion_categoria')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- BOTONES DE ACCIÓN --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('categoria.index') }}"
               class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors">
                Cancelar
            </a>
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-all shadow-sm shadow-red-600/20 hover:shadow-md">
                Guardar categoría
            </button>
        </div>

    </form>

</div>

@endsection