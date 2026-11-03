@extends('layouts.gestion')

@section('titulo')
    Editar Cliente
@endsection

@section('contenido')

{{-- NAVEGACIÓN Y ENCABEZADO --}}
<div class="mb-8 max-w-3xl mx-auto">
    <a href="{{ route('cliente.index') }}" 
       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition-colors mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Volver a clientes
    </a>
    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Editar cliente</h1>
    <p class="text-base text-gray-500 mt-1">Actualiza los datos de contacto o dirección del cliente.</p>
</div>

{{-- ALERTAS DE ERROR --}}
@if ($errors->any())
    <div class="max-w-3xl mx-auto mb-6 p-4 rounded-2xl bg-red-50 border border-red-200/70 text-red-800 text-sm">
        <div class="flex items-center gap-2 font-semibold mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            Por favor corrige los siguientes errores:
        </div>
        <ul class="list-disc list-inside text-xs text-red-700 space-y-0.5 ml-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- TARJETA DEL FORMULARIO --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 max-w-3xl mx-auto">

    <form action="{{ route('cliente.update', $cliente->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nombre Completo --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nombre completo</label>
            <input type="text"
                   name="nombre_cliente"
                   value="{{ old('nombre_cliente', $cliente->nombre_cliente) }}"
                   class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('nombre_cliente') border-red-500 @enderror">
            @error('nombre_cliente')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Teléfono y Correo --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Teléfono / WhatsApp</label>
                <input type="text"
                       name="telefono_cliente"
                       value="{{ old('telefono_cliente', $cliente->telefono_cliente) }}"
                       class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('telefono_cliente') border-red-500 @enderror">
                @error('telefono_cliente')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Correo electrónico</label>
                <input type="email"
                       name="correo_cliente"
                       value="{{ old('correo_cliente', $cliente->correo_cliente) }}"
                       class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('correo_cliente') border-red-500 @enderror">
                @error('correo_cliente')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Tipo y Número de Documento --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tipo de doc.</label>
                @php $tipoActual = old('tipo_documento', $cliente->tipo_documento); @endphp
                <select name="tipo_documento"
                        class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('tipo_documento') border-red-500 @enderror">
                    <option value="CC" @selected($tipoActual == 'CC')>Cédula (CC)</option>
                    <option value="TI" @selected($tipoActual == 'TI')>Tarjeta Identidad (TI)</option>
                    <option value="CE" @selected($tipoActual == 'CE')>Cédula Extranjería (CE)</option>
                    <option value="PP" @selected($tipoActual == 'PP')>Pasaporte (PP)</option>
                </select>
                @error('tipo_documento')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Número de documento</label>
                <input type="text"
                       name="numero_documento"
                       value="{{ old('numero_documento', $cliente->numero_documento) }}"
                       class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all font-mono @error('numero_documento') border-red-500 @enderror">
                @error('numero_documento')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Dirección y Ciudad --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Ciudad</label>
                <input type="text"
                       name="ciudad"
                       value="{{ old('ciudad', $cliente->ciudad) }}"
                       class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('ciudad') border-red-500 @enderror">
                @error('ciudad')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Dirección de entrega</label>
                <input type="text"
                       name="direccion"
                       value="{{ old('direccion', $cliente->direccion) }}"
                       class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('direccion') border-red-500 @enderror">
                @error('direccion')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- BOTONES DE ACCIÓN --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('cliente.index') }}"
               class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors">
                Cancelar
            </a>
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-all shadow-sm shadow-red-600/20 hover:shadow-md">
                Guardar cambios
            </button>
        </div>

    </form>

</div>

@endsection