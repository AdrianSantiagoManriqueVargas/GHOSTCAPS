<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión - @yield('titulo')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Permanent+Marker&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                        marker: ['"Permanent Marker"', 'cursive'],
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-[#f8f9fa] antialiased">

{{-- AVISO MÓVIL --}}
<div class="md:hidden fixed inset-0 z-50 bg-black flex flex-col items-center justify-center p-8 text-center">
    <div class="bg-red-600 rounded-full p-4 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
    </div>
    <h2 class="text-white text-xl font-bold mb-3">Panel de Gestión</h2>
    <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
        Para una mejor experiencia, accede al panel de gestión desde un computador o pantalla más grande.
    </p>
    <a href="{{ route('inicio') }}"
       class="mt-8 text-sm text-red-400 hover:text-red-300 transition-colors flex items-center gap-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Volver a la tienda
    </a>
</div>

<div class="flex min-h-screen">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-[#0e0e11] text-white flex flex-col fixed top-0 left-0 h-full z-20 border-r border-white/5">

        {{-- Logo GhostCaps --}}
        <div class="px-6 py-5">
            <div class="flex items-center gap-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
                <span class="font-bold text-lg tracking-tight">GhostCaps</span>
            </div>
        </div>

        {{-- Navegación --}}
        <nav class="flex-1 px-4 py-2 space-y-1 overflow-y-auto">

            <p class="text-[11px] font-bold uppercase tracking-widest text-gray-500 px-3 mb-2.5">Administración</p>

            {{-- Inicio --}}
            <a href="{{ route('gestion.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
               {{ request()->routeIs('gestion.index') 
                    ? 'bg-white/10 text-white shadow-sm' 
                    : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0 {{ request()->routeIs('gestion.index') ? 'text-red-500' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                <span class="flex-1">Inicio</span>
                @if (request()->routeIs('gestion.index'))
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 shadow-sm"></span>
                @endif
            </a>

            {{-- Productos --}}
            <a href="{{ route('producto.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
               {{ request()->routeIs('producto.*') 
                    ? 'bg-white/10 text-white shadow-sm' 
                    : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0 {{ request()->routeIs('producto.*') ? 'text-red-500' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <span class="flex-1">Productos</span>
                <span class="text-xs text-gray-400 font-semibold">{{ \App\Models\Producto::count() }}</span>
                @if (request()->routeIs('producto.*'))
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 shadow-sm"></span>
                @endif
            </a>

            {{-- Categorías --}}
            <a href="{{ route('categoria.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
               {{ request()->routeIs('categoria.*') 
                    ? 'bg-white/10 text-white shadow-sm' 
                    : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0 {{ request()->routeIs('categoria.*') ? 'text-red-500' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l7 7a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0l-7-7A1 1 0 014 11.586V7a4 4 0 014-4z"/>
                </svg>
                <span class="flex-1">Categorías</span>
                <span class="text-xs text-gray-400 font-semibold">{{ \App\Models\Categoria::count() }}</span>
                @if (request()->routeIs('categoria.*'))
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 shadow-sm"></span>
                @endif
            </a>

            {{-- Pedidos --}}
            <a href="#"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all text-gray-400 hover:text-white hover:bg-white/5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="flex-1">Pedidos</span>
                <span class="text-xs text-gray-400 font-semibold">{{ \App\Models\Pedido::count() }}</span>
            </a>

            {{-- Clientes --}}
            <a href="{{ route('cliente.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
               {{ request()->routeIs('cliente.*') 
                    ? 'bg-white/10 text-white shadow-sm' 
                    : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0 {{ request()->routeIs('cliente.*') ? 'text-red-500' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5.13a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="flex-1">Clientes</span>
                <span class="text-xs text-gray-400 font-semibold">{{ \App\Models\Cliente::count() }}</span>
                @if (request()->routeIs('cliente.*'))
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 shadow-sm"></span>
                @endif
            </a>

        </nav>

        {{-- Tarjeta "Tu marca, en la calle." --}}
        <div class="p-3 mx-3 mb-2 rounded-xl bg-white/[0.04] border border-white/5">
            <p class="text-xs font-semibold text-white">Tu marca, en la calle.</p>
            <p class="text-xs text-gray-400 mt-1 leading-relaxed">Revisa cómo se ve tu catálogo en la tienda.</p>
            <a href="{{ route('inicio') }}" target="_blank"
               class="inline-flex items-center gap-1.5 text-xs font-medium text-white hover:text-red-400 transition-colors mt-2.5">
                Ver tienda
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
        </div>

        {{-- Usuario --}}
        <div class="px-4 py-3.5 border-t border-white/5 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-neutral-800 border border-white/10 flex items-center justify-center text-xs font-bold text-gray-200 shrink-0">
                GC
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">Administrador</p>
                <p class="text-xs text-gray-400 truncate">GhostCaps</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                @csrf
                <button type="submit" title="Cerrar sesión"
                   class="text-gray-500 hover:text-white transition-colors p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>

    </aside>

    {{-- ===== ÁREA PRINCIPAL ===== --}}
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        {{-- TOPBAR --}}
        <header class="sticky top-0 z-10 bg-white/95 backdrop-blur-sm border-b border-gray-200/80 px-8 py-3.5 flex items-center gap-4">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-gray-500 flex-1">
                <span>Panel de gestión</span>
                <span class="text-gray-300">›</span>
                <span class="font-medium text-gray-900">@yield('titulo')</span>
            </nav>

            {{-- Buscador (decorativo) --}}
            <div class="relative">
                <input type="text" placeholder="Buscar en el panel..."
                       class="border border-gray-200 rounded-xl pl-4 pr-12 py-2 text-sm text-gray-600 bg-gray-50/70 focus:outline-none focus:ring-2 focus:ring-black/10 focus:bg-white w-64 transition-all">
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[11px] text-gray-400 bg-gray-200/80 rounded px-1.5 py-0.5 font-mono">⌘K</span>
            </div>

            {{-- Ver tienda --}}
            <a href="{{ route('inicio') }}" target="_blank"
               class="flex items-center gap-1.5 text-sm font-medium text-gray-700 hover:text-black transition-colors pl-2">
                Ver tienda
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>

        </header>

        {{-- CONTENIDO --}}
        <main class="flex-1 p-8">
            @if (session('mensaje'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 mb-6 rounded-xl text-sm flex items-center justify-between">
                    <span>{{ session('mensaje') }}</span>
                </div>
            @endif

            @yield('contenido')
        </main>

        {{-- FOOTER SUTIL DEL PANEL --}}
        <footer class="mt-auto px-8 py-5 border-t border-gray-200/60 flex items-center justify-between text-xs text-gray-400">
            <p>GhostCaps <span class="mx-1.5">·</span> Panel de gestión</p>
            <p>Hecho para mantener tu tienda en orden</p>
        </footer>

    </div>

</div>

</body>
</html>