@extends('layouts.gestion')

@section('titulo')
    Crear Producto
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
    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Nuevo producto</h1>
    <p class="text-base text-gray-500 mt-1">Completa los datos para añadir una nueva gorra al catálogo.</p>
</div>

{{-- ALERTAS DE ERROR GENERALES --}}
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

{{-- TARJETA DEL FORMULARIO --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 max-w-4xl mx-auto">

    <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- SECCIÓN 1: INFORMACIÓN BÁSICA --}}
        <div>
            <h2 class="text-base font-semibold text-gray-900 mb-1">Información de la gorra</h2>
            <p class="text-sm text-gray-400 mb-5">Nombre comercial, categoría y detalles descriptivos.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Categoría --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Categoría</label>
                    <select name="id_categoria"
                            class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('id_categoria') border-red-500 @enderror">
                        <option value="" disabled {{ old('id_categoria') ? '' : 'selected' }}>Selecciona una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @selected(old('id_categoria') == $categoria->id)>
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
                           value="{{ old('nombre_producto') }}"
                           placeholder="Ej: Street Cap Black Ghost"
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
                          placeholder="Describe el estilo, materiales, tipo de visera, ajuste..."
                          class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all resize-y @error('descripcion_producto') border-red-500 @enderror">{{ old('descripcion_producto') }}</textarea>
                @error('descripcion_producto')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <hr class="border-gray-100">

        {{-- SECCIÓN 2: PRECIO Y STOCK --}}
        <div>
            <h2 class="text-base font-semibold text-gray-900 mb-1">Precio e inventario</h2>
            <p class="text-sm text-gray-400 mb-5">Define el valor de venta y las unidades disponibles.</p>

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
                               value="{{ old('precio') }}"
                               placeholder="65000"
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
                           value="{{ old('stock', 1) }}"
                           placeholder="10"
                           class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('stock') border-red-500 @enderror">
                    @error('stock')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <hr class="border-gray-100">

        {{-- SECCIÓN 3: COLORES --}}
        <div>
            <h2 class="text-base font-semibold text-gray-900 mb-1">Variantes de color</h2>
            <p class="text-sm text-gray-400 mb-5">Selecciona el color principal y un secundario opcional.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Color Principal --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Color principal <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-2.5">
                        <input type="text"
                               name="colores[0][nombre_color]"
                               placeholder="Ej: Negro mate"
                               value="{{ old('colores.0.nombre_color') }}"
                               class="flex-1 bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black transition-all @error('colores.0.nombre_color') border-red-500 @enderror">
                        <input type="color"
                               name="colores[0][codigo_hex]"
                               value="{{ old('colores.0.codigo_hex', '#000000') }}"
                               class="w-12 h-11 p-1 bg-white border border-gray-200 rounded-xl cursor-pointer shrink-0">
                    </div>
                    @error('colores.0.nombre_color')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Color Secundario --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Color secundario (opcional)</label>
                    <div class="flex items-center gap-2.5">
                        <input type="text"
                               name="colores[1][nombre_color]"
                               placeholder="Ej: Rojo fuego (o vacío)"
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

        {{-- SECCIÓN 4: IMÁGENES (100% HTML + TAILWIND, CERO JS) --}}
        <div>
            <h2 class="text-base font-semibold text-gray-900 mb-1">Imágenes del producto</h2>
            <p class="text-sm text-gray-400 mb-4">Sube una o varias fotografías (JPG, PNG o WEBP, máx. 3MB cada una).</p>

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
                   @checked(old('destacado'))>
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
                Guardar producto
            </button>
        </div>

    </form>

</div>

@endsection