@extends('layouts.app')

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
                <input name="descripcion_producto">
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Color</label>
                <select name="color" class="">
                    @php $colorActual = old('color'); @endphp
                    <option @selected($colorActual == 'Rojo')>Rojo</option>
                    <option @selected($colorActual == 'Negro')>Negro</option>
                    <option @selected($colorActual == 'Blanco')>Blanco</option>
                    <option @selected($colorActual == 'Azul')>Azul</option>
                </select>
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