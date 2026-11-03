@extends('layouts.gestion')

@section('titulo')
    Clientes
@endsection

@section('contenido')

{{-- ENCABEZADO (Solo informativo, sin botón de creación manual) --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Clientes</h1>
    <p class="text-base text-gray-500 mt-1">Directorio de compradores registrados automáticamente a través de la tienda.</p>
</div>

{{-- CONTENEDOR DE LA TABLA --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    @if ($clientes->isEmpty())
        <div class="py-20 text-center">
            <div class="w-16 h-16 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5.13a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <p class="text-base font-semibold text-gray-900">Aún no hay clientes registrados</p>
            <p class="text-sm text-gray-400 mt-1 max-w-sm mx-auto">Cuando los compradores completen su primer pedido en el checkout, se añadirán automáticamente aquí.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/60">
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Cliente</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Documento</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Teléfono</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Ubicación</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($clientes as $cliente)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            
                            {{-- Info Cliente (Avatar + Nombre + Correo) --}}
                            <td class="py-4.5 px-7">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-10 h-10 rounded-full bg-neutral-900 text-white flex items-center justify-center font-semibold text-xs shrink-0 tracking-wider">
                                        {{ strtoupper(substr($cliente->nombre_cliente, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-base font-semibold text-gray-900 leading-snug">{{ $cliente->nombre_cliente }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $cliente->correo_cliente }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Documento --}}
                            <td class="py-4.5 px-7">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-100 text-gray-700 text-xs font-medium font-mono">
                                    <span class="text-gray-400">{{ $cliente->tipo_documento }}</span>
                                    {{ $cliente->numero_documento }}
                                </span>
                            </td>

                            {{-- Teléfono --}}
                            <td class="py-4.5 px-7 text-sm text-gray-600 font-medium">
                                {{ $cliente->telefono_cliente }}
                            </td>

                            {{-- Ubicación --}}
                            <td class="py-4.5 px-7">
                                <p class="text-sm font-medium text-gray-800">{{ $cliente->ciudad }}</p>
                                <p class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $cliente->direccion }}</p>
                            </td>

                            {{-- Acciones (Editar para corregir datos) --}}
                            <td class="py-4.5 px-7 text-right">
                                <a href="{{ route('cliente.edit', $cliente->id) }}"
                                   title="Editar datos de cliente"
                                   class="p-2 text-gray-400 hover:text-black hover:bg-gray-100 rounded-lg transition-colors inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="px-7 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $clientes->links() }}
        </div>
    @endif

</div>

@endsection