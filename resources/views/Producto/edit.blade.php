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

        <form action="{{ route('producto.update', $producto->id) }}" method="post" enctype="multipart/form-data">
            
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Nombre Categoria</label>
                <select name="id_categoria" id="id_categoria" class="">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"->{{ $categoria->nombre_categoria}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Nombre Producto</label>
                <input class="" name="nombre_producto" value="{{ old('nombre_producto', $producto->nombre_producto) }}">
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Descripcion</label>
                <input class="" name="descripcion_producto" value="{{ old('descripcion_producto', $producto->descripcion_producto) }}">
            </div>

            <div class="mb-5">          
                <label for="" class="block mb-2 font-semibold">Color</label>
                <select name="color" class="">
                    @php $colorActual = old('color', $producto->color); @endphp
                    <option @selected($colorActual == 'Rojo')>Rojo</option>
                    <option @selected($colorActual == 'Negro')>Negro</option>
                    <option @selected($colorActual == 'Blanco')>Blanco</option>
                    <option @selected($colorActual == 'Azul')>Azul</option>
                </select>
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Precio</label>
                <input class="" name="precio" type="number" value="{{ old('precio', $producto->precio) }}">
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Stock</label>
                <input class="" name="stock" type="number" value="{{ old('stock', $producto->stock) }}">
            </div>

            <div>
                <label for="" class="block mb-2 font-semibold">Imagenes</label>
                <input name="imagenes[]" type="file" multiple>
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

            <h3>Imagenes actuales</h3>

            <div>
                @forelse ($producto->imagen_producto as $imagen)
                    <div>
                        <img src="{{ asset('storage/' . $imagen->url_imagen) }}" width="100">
                        <form action="{{ route('imagenproducto.destroy', $imagen->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="">Eliminar</button>
                        </form>
                    </div>
                @empty
                    <p>Este producto no tiene imagenes</p>
                @endforelse
            </div>
        
    </div>

</div>

@endsection