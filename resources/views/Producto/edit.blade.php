@extends('layouts.app')

@section('titulo')
    Editar Producto
@endsection

@section('contenido')

<div class="">

    <div class="">

        <h2 class="">

            Editar Producto

        </h2>

            @if($errors->any())
                <div class="">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form action="{{ route('producto.update', $producto->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="" class="">Nombre Categoria</label>
                <select name="id_categoria" id="id_categoria" class="">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"->{{ $categoria->nombre_categoria}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Nombre Producto</label>
                <input class="" name="nombre_producto">
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Descripcion</label>
                <input class="" name="descripcion_producto">
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Precio</label>
                <input class="" name="precio" type="number">
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Stock</label>
                <input class="" name="stock" type="number">
            </div>

            <div>
                <button type="submit" class="">
                    Guardar
                </button>
                <a href="{{ route('producto.index') }}" class="">
                    Cancelar
                </a>
            </div>

        </form>
        
    </div>

</div>

@endsection