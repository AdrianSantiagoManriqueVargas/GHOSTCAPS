@extends('layouts.gestion')

@section('titulo')
    Categoria
@endsection

@section('contenido')

    <div class="bg-white rounded-lg shadow-sm border">

        <div class="flex justify-between items-center p-5 border-b">
            <h2 class="text-xl font-bold text-gray-800">
                Listado de Categorías
            </h2>
            <a href="{{ route('categoria.create') }}" class="bg-black text-white text-sm px-4 py-2 rounded hover:bg-gray-800 transition-colors">
                Nueva Categoría
            </a>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Nombre Categoría</th>
                    <th class="p-3">Descripción</th>
                    <th class="p-3">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach ($categorias as $categoria)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 text-gray-500">{{ $categoria->id }}</td>
                        <td class="p-3 font-medium text-gray-800">{{ $categoria->nombre_categoria }}</td>
                        <td class="p-3 text-gray-600">{{ $categoria->descripcion_categoria }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <a href="{{ route('categoria.edit', $categoria->id) }}" class="bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1.5 rounded hover:bg-blue-100 transition-colors">
                                    Editar
                                </a>
                                <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta categoría?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-700 text-xs font-semibold px-3 py-1.5 rounded hover:bg-red-100 transition-colors">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4 border-t">
            {{ $categorias->links() }}
        </div>

    </div>

@endsection