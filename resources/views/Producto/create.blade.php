@extends('layouts.gestion')

@section('titulo')
    Crear Producto
@endsection

@section('contenido')

@if ($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-800 rounded p-4 mb-5 max-w-2xl mx-auto">
        <strong>Errores:</strong>
        <ul class="list-disc list-inside mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border p-6 max-w-4xl mx-auto">

    <h2 class="text-xl font-bold text-gray-800 mb-5">
        Nuevo Producto
    </h2>

    <form action="{{ route('producto.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Categoria</label>
                <select name="id_categoria" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Nombre Producto</label>
                <input name="nombre_producto" value="{{ old('nombre_producto') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>
        </div>

        <div class="mb-5">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Descripcion</label>
            <input name="descripcion_producto" value="{{ old('descripcion_producto') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Color principal</label>
                <div class="flex gap-2 items-center">
                    <input type="text" name="colores[0][nombre_color]" placeholder="Nombre del color" value="{{ old('colores.0.nombre_color') }}" class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    <input type="color" name="colores[0][codigo_hex]" value="{{ old('colores.0.codigo_hex', '#000000') }}" class="w-12 h-10 border rounded shrink-0">
                </div>
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Color secundario (opcional)</label>
                <div class="flex gap-2 items-center">
                    <input type="text" name="colores[1][nombre_color]" placeholder="Déjalo vacío si no aplica" value="{{ old('colores.1.nombre_color') }}" class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    <input type="color" name="colores[1][codigo_hex]" value="{{ old('colores.1.codigo_hex', '#000000') }}" class="w-12 h-10 border rounded shrink-0">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Precio</label>
                <input name="precio" type="number" value="{{ old('precio') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Stock</label>
                <input name="stock" type="number" value="{{ old('stock') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>
        </div>

        <div class="mb-6 flex items-center gap-3">
            <input type="hidden" name="destacado" value="0">
            <input type="checkbox" id="destacado" name="destacado" value="1" class="h-4 w-4" @checked(old('destacado'))>
            <label for="destacado" class="text-sm font-semibold text-gray-700">
                Portada de su categoría
                <span class="block text-xs font-normal text-gray-500">Su foto se muestra en la tarjeta de su categoría en el inicio.</span>
            </label>

        <div class="mb-6">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Imagenes</label>
            <input name="imagenes[]" type="file" multiple class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-black text-white px-5 py-2 rounded hover:bg-gray-800 transition-colors">
                Guardar
            </button>
            <a href="{{ route('producto.index') }}" class="text-gray-600 hover:underline">
                Cancelar
            </a>
        </div>

    </form>

</div>

@endsection