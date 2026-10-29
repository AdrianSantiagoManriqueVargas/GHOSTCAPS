@extends('layouts.gestion')

@section('titulo')
    Editar Producto
@endsection

@section('contenido')

<div class="bg-white rounded-lg shadow-sm border p-6 max-w-4xl mx-auto">

    <h2 class="text-xl font-bold text-gray-800 mb-5">
        Editar Producto
    </h2>

    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 rounded p-4 mb-5">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('producto.update', $producto->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Categoria</label>
                <select name="id_categoria" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(old('id_categoria', $producto->id_categoria) == $categoria->id)>{{ $categoria->nombre_categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Nombre Producto</label>
                <input name="nombre_producto" value="{{ old('nombre_producto', $producto->nombre_producto) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>
        </div>

        <div class="mb-5">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Descripcion</label>
            <input name="descripcion_producto" value="{{ old('descripcion_producto', $producto->descripcion_producto) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Agregar color principal nuevo (opcional)</label>
                <div class="flex gap-2 items-center">
                    <input type="text" name="colores[0][nombre_color]" placeholder="Déjalo vacío si no quieres agregar uno" class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    <input type="color" name="colores[0][codigo_hex]" value="#000000" class="w-12 h-10 border rounded shrink-0">
                </div>
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Agregar color secundario nuevo (opcional)</label>
                <div class="flex gap-2 items-center">
                    <input type="text" name="colores[1][nombre_color]" placeholder="Déjalo vacío si no quieres agregar uno" class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                    <input type="color" name="colores[1][codigo_hex]" value="#000000" class="w-12 h-10 border rounded shrink-0">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Precio</label>
                <input name="precio" type="number" value="{{ old('precio', $producto->precio) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">Stock</label>
                <input name="stock" type="number" value="{{ old('stock', $producto->stock) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>
        </div>

        <div class="mb-6">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Imagenes</label>
            <input name="imagenes[]" type="file" multiple class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-6 flex items-center gap-3">
            <input type="hidden" name="destacado" value="0">
            <input type="checkbox" id="destacado" name="destacado" value="1" class="h-4 w-4" @checked(old('destacado', $producto->destacado))>
            <label for="destacado" class="text-sm font-semibold text-gray-700">
                Portada de su categoría
                <span class="block text-xs font-normal text-gray-500">Su foto se muestra en la tarjeta de su categoría en el inicio.</span>
            </label>
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

    <hr class="my-6">

    <h3 class="text-lg font-semibold text-gray-800 mb-3">Imagenes actuales</h3>

    <div class="flex flex-wrap gap-4 mb-6">
        @forelse ($producto->imagen_producto as $imagen)
            <div class="relative">
                <img src="{{ asset('storage/' . $imagen->url_imagen) }}" class="w-24 h-24 object-cover rounded border">
                <form action="{{ route('imagenproducto.destroy', $imagen->id) }}" method="post" class="absolute -top-2 -right-2" onsubmit="return confirm('¿Eliminar esta imagen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Eliminar imagen" class="bg-red-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold leading-none hover:bg-red-700 shadow">
                        ×
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-400">Este producto no tiene imagenes</p>
        @endforelse
    </div>

    <h3 class="text-lg font-semibold text-gray-800 mb-3">Colores actuales</h3>

    <div class="flex flex-wrap gap-3">
        @forelse ($producto->color_producto as $color)
            <div class="relative flex items-center gap-2 border rounded-full pl-2 pr-3 py-1 bg-gray-50">
                <span class="inline-block w-6 h-6 rounded-full border" style="background-color: {{ $color->codigo_hex }}"></span>
                <span class="text-sm text-gray-700">{{ $color->nombre_color }}</span>
                <form action="{{ route('colorproducto.destroy', $color->id) }}" method="post" class="absolute -top-1.5 -right-1.5" onsubmit="return confirm('¿Eliminar este color?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Eliminar color" class="bg-red-600 text-white w-5 h-5 rounded-full flex items-center justify-center text-xs font-bold leading-none hover:bg-red-700 shadow">
                        ×
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-400">Este producto no tiene colores</p>
        @endforelse
    </div>

</div>

@endsection