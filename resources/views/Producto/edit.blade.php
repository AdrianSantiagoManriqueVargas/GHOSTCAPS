@extends('layouts.gestion')

@section('titulo')
    Editar Producto
@endsection

@section('contenido')

{{-- NAVEGACIÓN Y ENCABEZADO --}}
<div class="mb-8 max-w-4xl mx-auto">
    <a href="{{ route('producto.index') }}" 
       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition-colors mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Volver a productos
    </a>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Editar producto</h1>
            <p class="text-base text-gray-500 mt-1">Actualiza los datos, precios, existencias y contenido multimedia de la gorra.</p>
        </div>
        <a href="{{ route('catalogo.producto', $producto->id) }}" 
           target="_blank"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-black px-4 py-2 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 transition-colors">
            Ver en tienda
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
        </a>
    </div>
</div>

{{-- ALERTAS DE ERROR --}}
@if ($errors->any())
    <div class="max-w-4xl mx-auto mb-6 p-4 rounded-2xl bg-red-50 border border-red-200/70 text-red-800 text-sm">
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

<div class="max-w-4xl mx-auto space-y-6">

    {{-- TARJETA PRINCIPAL: FORMULARIO DE ACTUALIZACIÓN --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">

        <form action="{{ route('producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- SECCIÓN 1: INFORMACIÓN BÁSICA --}}
            <div>
                <h2 class="text-base font-semibold text-gray-900 mb-1">Información de la gorra</h2>
                <p class="text-sm text-gray-400 mb-5">Modifica la categoría, nombre o descripción comercial.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Categoría --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Categoría</label>
                        <select name="id_categoria"
                                class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('id_categoria') border-red-500 @enderror">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected(old('id_categoria', $producto->id_categoria) == $categoria->id)>
                                    {{ $categoria->nombre_categoria }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_categoria')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nombre --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nombre del producto</label>
                        <input type="text"
                               name="nombre_producto"
                               value="{{ old('nombre_producto', $producto->nombre_producto) }}"
                               class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('nombre_producto') border-red-500 @enderror">
                        @error('nombre_producto')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="mt-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Descripción</label>
                    <textarea name="descripcion_producto"
                              rows="3"
                              class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all resize-y @error('descripcion_producto') border-red-500 @enderror">{{ old('descripcion_producto', $producto->descripcion_producto) }}</textarea>
                    @error('descripcion_producto')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- SECCIÓN 2: PRECIO Y STOCK --}}
            <div>
                <h2 class="text-base font-semibold text-gray-900 mb-1">Precio e inventario</h2>
                <p class="text-sm text-gray-400 mb-5">Ajusta el precio de venta y el stock actual.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Precio --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Precio ($)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">$</span>
                            <input type="number"
                                   name="precio"
                                   min="0"
                                   step="500"
                                   value="{{ old('precio', $producto->precio) }}"
                                   class="w-full bg-gray-50/50 border border-gray-200 rounded-xl pl-8 pr-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('precio') border-red-500 @enderror">
                        </div>
                        @error('precio')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stock --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Stock disponible</label>
                        <input type="number"
                               name="stock"
                               min="0"
                               value="{{ old('stock', $producto->stock) }}"
                               class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('stock') border-red-500 @enderror">
                        @error('stock')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- SECCIÓN 3: AGREGAR NUEVOS COLORES --}}
            <div>
                <h2 class="text-base font-semibold text-gray-900 mb-1">Agregar nuevos colores</h2>
                <p class="text-sm text-gray-400 mb-5">Puedes añadir una o dos variantes adicionales (opcional).</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nuevo color (opcional)</label>
                        <div class="flex items-center gap-2.5">
                            <input type="text"
                                   name="colores[0][nombre_color]"
                                   placeholder="Dejar vacío si no aplica"
                                   value="{{ old('colores.0.nombre_color') }}"
                                   class="flex-1 bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all">
                            <input type="color"
                                   name="colores[0][codigo_hex]"
                                   value="{{ old('colores.0.codigo_hex', '#000000') }}"
                                   class="w-12 h-11 p-1 bg-white border border-gray-200 rounded-xl cursor-pointer shrink-0">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Segundo color nuevo (opcional)</label>
                        <div class="flex items-center gap-2.5">
                            <input type="text"
                                   name="colores[1][nombre_color]"
                                   placeholder="Dejar vacío si no aplica"
                                   value="{{ old('colores.1.nombre_color') }}"
                                   class="flex-1 bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all">
                            <input type="color"
                                   name="colores[1][codigo_hex]"
                                   value="{{ old('colores.1.codigo_hex', '#dc2626') }}"
                                   class="w-12 h-11 p-1 bg-white border border-gray-200 rounded-xl cursor-pointer shrink-0">
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- SECCIÓN 4: AGREGAR MÁS FOTOS --}}
            <div>
                <h2 class="text-base font-semibold text-gray-900 mb-1">Agregar más fotos</h2>
                <p class="text-sm text-gray-400 mb-4">Si deseas añadir más fotos a la galería de esta gorra, elígelas aquí (opcional).</p>

                <div class="bg-gray-50/50 border border-gray-200 rounded-2xl p-4">
                    <input type="file" 
                           name="imagenes[]" 
                           id="imagenes" 
                           multiple 
                           accept="image/png,image/jpeg,image/webp,image/jpg"
                           class="block w-full text-sm text-gray-600
                                  file:mr-4 file:py-2.5 file:px-5
                                  file:rounded-xl file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-black file:text-white
                                  hover:file:bg-gray-800 file:cursor-pointer cursor-pointer">
                    
                    <p class="text-xs text-gray-400 mt-2.5">
                        Tip: Mantén presionada la tecla <kbd class="px-1.5 py-0.5 bg-gray-200 text-gray-700 rounded text-[11px] font-mono">Ctrl</kbd> para elegir varias fotos al tiempo.
                    </p>
                </div>

                @error('imagenes')
                    <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                @enderror
                @error('imagenes.*')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <hr class="border-gray-100">

            {{-- SECCIÓN 5: DESTACADO / PORTADA --}}
            <div class="p-4 rounded-xl bg-gray-50/80 border border-gray-100 flex items-start gap-3.5">
                <input type="hidden" name="destacado" value="0">
                <input type="checkbox"
                       id="destacado"
                       name="destacado"
                       value="1"
                       class="mt-1 w-4 h-4 rounded text-red-600 focus:ring-red-500 border-gray-300"
                       @checked(old('destacado', $producto->destacado))>
                <label for="destacado" class="cursor-pointer select-none">
                    <span class="text-sm font-semibold text-gray-900 block">Portada de su categoría (destacado)</span>
                    <span class="text-xs text-gray-500 mt-0.5 block leading-relaxed">
                        Si se marca, la primera foto de esta gorra se utilizará automáticamente como portada de su categoría en la página de inicio.
                    </span>
                </label>
            </div>

            {{-- BOTONES DE ACCIÓN --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('producto.index') }}"
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

    {{-- TARJETA 2: GESTIÓN DE ELEMENTOS ACTUALES (FOTOS Y COLORES) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- FOTOS ACTUALES --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-base font-semibold text-gray-900 mb-1">Fotos actuales</h2>
            <p class="text-xs text-gray-400 mb-4">Haz clic en la "x" para eliminar una foto permanentemente.</p>

            <div class="flex flex-wrap gap-3">
                @forelse ($producto->imagen_producto as $imagen)
                    <div class="relative w-20 h-20 rounded-xl overflow-hidden bg-gray-100 border border-gray-200 group">
                        <img src="{{ asset('storage/' . $imagen->url_imagen) }}" 
                             alt="Foto gorra" 
                             class="w-full h-full object-cover">
                        
                        <form action="{{ route('imagenproducto.destroy', $imagen->id) }}" 
                              method="POST" 
                              class="absolute top-1 right-1" 
                              onsubmit="return confirm('¿Seguro que deseas eliminar esta fotografía?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    title="Eliminar foto" 
                                    class="w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center text-xs font-bold shadow-md transition-transform hover:scale-110">
                                ×
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 italic py-2">Esta gorra aún no tiene fotos registradas.</p>
                @endforelse
            </div>
        </div>

        {{-- COLORES ACTUALES --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-base font-semibold text-gray-900 mb-1">Colores actuales</h2>
            <p class="text-xs text-gray-400 mb-4">Haz clic en la "x" para retirar un color del producto.</p>

            <div class="flex flex-wrap gap-2.5">
                @forelse ($producto->color_producto as $color)
                    <div class="inline-flex items-center gap-2 pl-2 pr-1.5 py-1 rounded-full bg-gray-50 border border-gray-200/80 shadow-2xs">
                        <span class="w-4 h-4 rounded-full border border-gray-300 shrink-0" 
                              style="background-color: {{ $color->codigo_hex }}"></span>
                        <span class="text-xs font-medium text-gray-800">{{ $color->nombre_color }}</span>
                        
                        <form action="{{ route('colorproducto.destroy', $color->id) }}" 
                              method="POST" 
                              class="inline-block"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este color?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    title="Eliminar color" 
                                    class="w-5 h-5 rounded-full hover:bg-red-100 text-gray-400 hover:text-red-600 flex items-center justify-center text-xs font-bold transition-colors">
                                ×
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 italic py-2">Esta gorra no tiene colores asignados.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>

@endsection