@extends('layouts.gestion')

@section('titulo')
    Crear Categoria
@endsection

@section('contenido')

@if ($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-800 rounded p-4 mb-5">
        <strong>Errores:</strong>
        <ul class="list-disc list-inside mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border p-6 max-w-xl mx-auto">

    <h2 class="text-xl font-bold text-gray-800 mb-5">
        Nueva Categoría
    </h2>

    <form action="{{ route('categoria.store') }}" method="post">
        @csrf

        <div class="mb-5">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Nombre Categoria</label>
            <input name="nombre_categoria" value="{{ old('nombre_categoria') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="mb-6">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Descripcion</label>
            <input name="descripcion_categoria" value="{{ old('descripcion_categoria') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-black text-white px-5 py-2 rounded hover:bg-gray-800 transition-colors">
                Guardar
            </button>
            <a href="{{ route('categoria.index') }}" class="text-gray-600 hover:underline">
                Cancelar
            </a>
        </div>

    </form>

</div>

@endsection