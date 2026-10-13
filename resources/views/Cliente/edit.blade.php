@extends('layouts.gestion')

@section('titulo')
    Editar Cliente
@endsection

@section('contenido')

<div class="bg-white rounded-lg shadow-sm border p-6 max-w-xl mx-auto">

    <h2 class="text-xl font-bold text-gray-800 mb-5">Editar Cliente</h2>

    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 rounded p-4 mb-5">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cliente.update', $cliente->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Nombre</label>
            <input name="nombre_cliente" value="{{ old('nombre_cliente', $cliente->nombre_cliente) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Telefono</label>
            <input name="telefono_cliente" value="{{ old('telefono_cliente', $cliente->telefono_cliente) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Correo</label>
            <input name="correo_cliente" type="email" value="{{ old('correo_cliente', $cliente->correo_cliente) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Tipo de documento</label>
            @php $tipoActual = old('tipo_documento', $cliente->tipo_documento); @endphp
            <select name="tipo_documento" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                <option value="CC" @selected($tipoActual == 'CC')>CC</option>
                <option value="TI" @selected($tipoActual == 'TI')>TI</option>
                <option value="CE" @selected($tipoActual == 'CE')>CE</option>
                <option value="PP" @selected($tipoActual == 'PP')>PP</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Numero de documento</label>
            <input name="numero_documento" value="{{ old('numero_documento', $cliente->numero_documento) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Direccion</label>
            <input name="direccion" value="{{ old('direccion', $cliente->direccion) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="mb-6">
            <label class="block mb-1 text-sm font-semibold text-gray-700">Ciudad</label>
            <input name="ciudad" value="{{ old('ciudad', $cliente->ciudad) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-black text-white px-5 py-2 rounded hover:bg-gray-800 transition-colors">Guardar</button>
            <a href="{{ route('cliente.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
        </div>

    </form>

</div>

@endsection