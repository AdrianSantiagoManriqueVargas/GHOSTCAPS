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
                <label for="" class="block mb-2 font-semibold">Color</label>
                <input type="color" name="color" value="{{ old('color', '#000000') }}">
            </div>

            <div class="mb-5">
                <label>
                    <input type="checkbox" name="tiene_color_secundario" value="1" {{ old('tiene_color_secundario') ? 'checked' : '' }}>
                    Tiene color secundario
                </label>
                <br>
                <label for="" class="block mb-2 font-semibold">Color secundario</label>
                <input type="color" name="color_secundario" value="{{ old('color_secundario', '#ffffff') }}">
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