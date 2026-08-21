    @extends('layouts.app')

    @section('titulo')
        Editar Categoria
    @endsection

    @section('contenido')
    <div class="">
        <div class="">
            <h2 class="">
                Editar Categoría
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

            <form action="{{route('categoria.update', $categoria->id)}}" method="post">
                @csrf 
                @method('PUT')

                <div class="">
                    <label for="" class="">Nombre Categoria</label>
                    <input type="text" name="nombre_categoria" value="{{$categoria->nombre_categoria}}" class="">
                </div>
                <div class="">
                    <label for="" class="">Descripcion</label>
                    <input type="text" name="descripcion_categoria" value="{{ $categoria->descripcion_categoria}}" class="">
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