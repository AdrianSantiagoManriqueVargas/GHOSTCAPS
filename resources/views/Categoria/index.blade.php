@extends('layouts.app')

@section('titulo')
    Categoria
@endsection

@section('contenido')

    <div class="container">
        <div class="">
            <div class="">
                <h2 class="">
                    Listado de Categorías
                </h2>
                <a href="{{ route('categoria.create') }}" class="">
                    Nueva Categoría
                </a>
            </div>

        <table class="">
            <thead class="">
                <tr>
                    <th class="">
                        ID
                    </th>
                    <th class="">
                        Nombre Categoría
                    </th>
                    <th class="">
                        Descripción
                    </th>
                    <th class="">
                        Acciones
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach ($categoria as $categoria)

                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre_categoria }}</td>
                    <td>{{ $categoria->descripcion_categoria }}</td>
                    <td>
                        <a href="{{ route('categoria.edit', $categoria->id) }}">Editar</a>
                        <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

        </div>
    </div>

@endsection