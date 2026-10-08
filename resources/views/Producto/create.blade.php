@extends('layouts.gestion')

@section('titulo')
    Crear Producto
@endsection

@section('contenido')

<div>

    <div>

        <h2>

            Nuevo Producto

        </h2>

        <form action="{{ route('producto.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="" class="block mb-2 font-semibold">Nombre Categoria</label>
                <select name="id_categoria" id="id_categoria">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="" class="block mb-2 font-semibold">Nombre Producto</label>
                <input name="nombre_producto">
            </div>

            <div>
                <label for="" class="block mb-2 font-semibold">Descripcion</label>
                <input class="w-96" name="descripcion_producto">
            </div>
            
            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Color principal</label>
                <div class="flex gap-3 items-center">
                    <input type="text" name="colores[0][nombre_color]" placeholder="Nombre del color" value="{{ old('colores.0.nombre_color') }}">
                    <input type="color" name="colores[0][codigo_hex]" value="{{ old('colores.0.codigo_hex', '#000000') }}">
                </div>
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Color secundario (opcional)</label>
                <div class="flex gap-3 items-center">
                    <input type="text" name="colores[1][nombre_color]" placeholder="Déjalo vacío si no aplica" value="{{ old('colores.1.nombre_color') }}">
                    <input type="color" name="colores[1][codigo_hex]" value="{{ old('colores.1.codigo_hex', '#000000') }}">
                </div>
            </div>

            <div>
                <label for="" class="block mb-2 font-semibold">Precio</label>
                <input name="precio" type="number">
            </div>

            <div>
                <label for="" class="block mb-2 font-semibold">Stock</label>
                <input name="stock" type="number">
            </div>

            <div>
                <label for="" class="block mb-2 font-semibold">Imagenes</label>
                <input name="imagenes[]" type="file" multiple>
            </div>

            <div>
                <button type="submit">
                    Guardar
                </button>
                <a href="{{ route('producto.index') }}">
                    Cancelar
                </a>
            </div>

        </form>
        
    </div>

</div>

@endsection