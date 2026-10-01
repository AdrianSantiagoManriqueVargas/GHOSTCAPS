@extends('layouts.app')

@section('titulo')
    Editar Cliente
@endsection

@section('contenido')

<div class="">

    <h2 class="">Editar Cliente</h2>

    @if($errors->any())
        <div class="">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cliente.update', $cliente->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="">
            <label for="">Nombre</label>
            <input name="nombre_cliente" value="{{ old('nombre_cliente', $cliente->nombre_cliente) }}">
        </div>

        <div class="">
            <label for="">Telefono</label>
            <input name="telefono_cliente" value="{{ old('telefono_cliente', $cliente->telefono_cliente) }}">
        </div>

        <div class="">
            <label for="">Correo</label>
            <input name="correo_cliente" type="email" value="{{ old('correo_cliente', $cliente->correo_cliente) }}">
        </div>

        <div class="">
            <label for="">Tipo de documento</label>
            @php $tipoActual = old('tipo_documento', $cliente->tipo_documento); @endphp
            <select name="tipo_documento">
                <option value="CC" @selected($tipoActual == 'CC')>CC</option>
                <option value="TI" @selected($tipoActual == 'TI')>TI</option>
                <option value="CE" @selected($tipoActual == 'CE')>CE</option>
                <option value="PP" @selected($tipoActual == 'PP')>PP</option>
            </select>
        </div>

        <div class="">
            <label for="">Numero de documento</label>
            <input name="numero_documento" value="{{ old('numero_documento', $cliente->numero_documento) }}">
        </div>

        <div class="">
            <label for="">Direccion</label>
            <input name="direccion" value="{{ old('direccion', $cliente->direccion) }}">
        </div>

        <div class="">
            <label for="">Ciudad</label>
            <input name="ciudad" value="{{ old('ciudad', $cliente->ciudad) }}">
        </div>

        <div class="">
            <button type="submit" class="">Guardar</button>
            <a href="{{ route('cliente.index') }}" class="">Cancelar</a>
        </div>

    </form>

</div>

@endsection