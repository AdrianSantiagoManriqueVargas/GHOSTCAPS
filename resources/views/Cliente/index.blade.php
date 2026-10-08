@extends('layouts.gestion')

@section('titulo')
    Clientes
@endsection

@section('contenido')

<div class="bg-white rounded-lg shadow-sm border">

    <div class="flex justify-between items-center p-5 border-b">
        <h2 class="text-xl font-bold text-gray-800">Clientes</h2>
        <a href="{{ route('cliente.create') }}" class="bg-black text-white text-sm px-4 py-2 rounded hover:bg-gray-800 transition-colors">Nuevo Cliente</a>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left text-gray-600 uppercase text-xs">
            <tr>
                <th class="p-3">Nombre</th>
                <th class="p-3">Teléfono</th>
                <th class="p-3">Correo</th>
                <th class="p-3">Documento</th>
                <th class="p-3">Ciudad</th>
                <th class="p-3">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($cliente as $cliente)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 font-medium text-gray-800">{{ $cliente->nombre_cliente }}</td>
                    <td class="p-3 text-gray-600">{{ $cliente->telefono_cliente }}</td>
                    <td class="p-3 text-gray-600">{{ $cliente->correo_cliente }}</td>
                    <td class="p-3 text-gray-600">{{ $cliente->tipo_documento }} {{ $cliente->numero_documento }}</td>
                    <td class="p-3 text-gray-600">{{ $cliente->ciudad }}</td>
                    <td class="p-3 flex gap-3">
                        <a href="{{ route('cliente.edit', $cliente->id) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('cliente.destroy', $cliente->id) }}" method="post" onsubmit="return confirm('¿Eliminar este cliente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-400">No hay clientes registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection