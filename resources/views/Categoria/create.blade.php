@extends('layouts.app')

@section('titulo')
    Crear Categoria
@endsection

@section('contenido')

<div class="">

    <div class="">

        <h2 class="">

            Nueva Categoría

        </h2>

        <form action="{{ route('categoria.store') }}" method="post">
            @csrf

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Nombre Categoria</label>
                <input class="" name="nombre_categoria">
            </div>

            <div class="mb-5">
                <label for="" class="block mb-2 font-semibold">Descripcion</label>
                <input class="" name="descripcion_categoria">
            </div>

            <div>
                <button type="submit" class="">
                    Guardar
                </button>
                <a href="{{ route('categoria.index') }}" class="">
                    Cancelar
                </a>
            </div>

        </form>
        
    </div>

</div>

@endsection