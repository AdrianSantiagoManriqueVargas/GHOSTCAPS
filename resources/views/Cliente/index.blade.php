@extends('layouts.gestion')

@section('titulo')
    Clientes
@endsection

@section('contenido')

<div class="">

    <h2 class="">Clientes</h2>

    <a href="{{ route('cliente.create') }}" class="">Nuevo Cliente</a>

    <table class="">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Documento</th>
                <th>Ciudad</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cliente as $cliente)
                <tr>
                    <td>{{ $cliente->nombre_cliente }}</td>
                    <td>{{ $cliente->telefono_cliente }}</td>
                    <td>{{ $cliente->correo_cliente }}</td>
                    <td>{{ $cliente->tipo_documento }} {{ $cliente->numero_documento }}</td>
                    <td>{{ $cliente->ciudad }}</td>
                    <td>
                        <a href="{{ route('cliente.edit', $cliente->id) }}" class="">Editar</a>
                        <form action="{{ route('cliente.destroy', $cliente->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay clientes registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection