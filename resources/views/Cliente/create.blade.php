@extends('layouts.gestion')

@section('titulo')
    Nuevo Cliente
@endsection

@section('contenido')

<div class="">

    <h2 class="">Nuevo Cliente</h2>

    @if($errors->any())
        <div class="">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cliente.store') }}" method="post">
        @csrf

        <div class="">
            <label for="">Nombre</label>
            <input name="nombre_cliente" value="{{ old('nombre_cliente') }}">
        </div>

        <div class="">
            <label for="">Telefono</label>
            <input name="telefono_cliente" value="{{ old('telefono_cliente') }}">
        </div>

        <div class="">
            <label for="">Correo</label>
            <input name="correo_cliente" type="email" value="{{ old('correo_cliente') }}">
        </div>

        <div class="">
            <label for="">Tipo de documento</label>
            <select name="tipo_documento">
                <option value="CC" @selected(old('tipo_documento') == 'CC')>CC</option>
                <option value="TI" @selected(old('tipo_documento') == 'TI')>TI</option>
                <option value="CE" @selected(old('tipo_documento') == 'CE')>CE</option>
                <option value="PP" @selected(old('tipo_documento') == 'PP')>PP</option>
            </select>
        </div>

        <div class="">
            <label for="">Numero de documento</label>
            <input name="numero_documento" value="{{ old('numero_documento') }}">
        </div>

        <div class="">
            <label for="">Direccion</label>
            <input name="direccion" value="{{ old('direccion') }}">
        </div>

        <div class="">
            <label for="">Ciudad</label>
            <input name="ciudad" value="{{ old('ciudad') }}">
        </div>

        <div class="">
            <button type="submit" class="">Guardar</button>
            <a href="{{ route('cliente.index') }}" class="">Cancelar</a>
        </div>

    </form>

</div>

@endsection