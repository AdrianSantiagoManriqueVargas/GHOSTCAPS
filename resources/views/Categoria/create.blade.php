@extends('layouts.app')

@section('titulo')
    Crear Categoria
@endsection

@section('contenido')

@if ($errors->any())
    <div style="background: #fee2e2; color: #991b1b; padding: 15px; margin-bottom: 20px;">
        <strong>Errores:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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