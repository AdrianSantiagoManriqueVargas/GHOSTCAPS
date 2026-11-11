@extends('layouts.gestion')

@section('titulo')
    Categorías
@endsection

@section('contenido')

{{-- ENCABEZADO --}}
<div class="flex items-start justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Categorías</h1>
        <p class="text-base text-gray-500 mt-1">Organiza las colecciones, tipos y estilos de gorras de tu tienda.</p>
    </div>
    <a href="{{ route('categoria.create') }}"
       class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all shadow-sm shadow-red-600/20 hover:shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Nueva categoría
    </a>
</div>

    {{-- ALERTAS DE ACCIÓN --}}
    @if (session('error'))
        <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 p-4 text-sm text-red-800 flex items-start gap-3 shadow-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div class="flex-1">
                <p class="font-bold text-red-900">Operación no permitida</p>
                <p class="mt-0.5 text-red-700 leading-relaxed">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4 text-sm font-semibold text-green-800 flex items-center gap-2 shadow-xs">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

{{-- CONTENEDOR DE LA TABLA --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    @if ($categorias->isEmpty())
        <div class="py-20 text-center">
            <div class="w-16 h-16 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l7 7a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0l-7-7A1 1 0 014 11.586V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <p class="text-base font-semibold text-gray-900">No hay categorías creadas</p>
            <p class="text-sm text-gray-400 mt-1 max-w-sm mx-auto">Crea categorías para clasificar tus productos (ej: Planas, Streetwear, Beanie...).</p>
            <a href="{{ route('categoria.create') }}"
               class="inline-flex items-center gap-2 mt-5 bg-black hover:bg-gray-800 text-white text-sm font-medium px-4 py-2 rounded-xl transition-colors">
                Crear categoría
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/60">
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">ID</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Categoría</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400">Descripción</th>
                        <th class="py-4 px-7 text-xs font-semibold uppercase tracking-wider text-gray-400 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($categorias as $categoria)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            
                            {{-- ID --}}
                            <td class="py-4.5 px-7 text-sm text-gray-400 font-mono">
                                #{{ $categoria->id }}
                            </td>

                            {{-- Nombre --}}
                            <td class="py-4.5 px-7">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-gray-100 border border-gray-200/60 flex items-center justify-center shrink-0 text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l7 7a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0l-7-7A1 1 0 014 11.586V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <p class="text-base font-semibold text-gray-900">{{ $categoria->nombre_categoria }}</p>
                                </div>
                            </td>

                            {{-- Descripción --}}
                            <td class="py-4.5 px-7 text-sm text-gray-500 max-w-md">
                                {{ $categoria->descripcion_categoria ?: 'Sin descripción' }}
                            </td>

                            {{-- Acciones --}}
                            <td class="py-4.5 px-7 text-right">
                                <div class="inline-flex items-center gap-1">
                                    
                                    {{-- Editar --}}
                                    <a href="{{ route('categoria.edit', $categoria->id) }}"
                                       title="Editar categoría"
                                       class="p-2 text-gray-400 hover:text-black hover:bg-gray-100 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>

                                    {{-- Eliminar --}}
                                    <form action="{{ route('categoria.destroy', $categoria->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar la categoría \'{{ $categoria->nombre_categoria }}\'?')"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                title="Eliminar categoría"
                                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="px-7 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $categorias->links() }}
        </div>
    @endif

</div>

@endsection