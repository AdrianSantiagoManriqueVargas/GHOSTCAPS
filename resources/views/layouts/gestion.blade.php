<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión - @yield('titulo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <nav class="sticky top-0 z-10 bg-black text-white px-8 py-3 flex items-center justify-between shadow-md">

        <div class="flex items-center gap-8">
            <a href="{{ route('gestion.index') }}" class="font-bold tracking-wide {{ request()->routeIs('gestion.index') ? 'text-red-500' : 'text-white hover:text-red-400' }} transition-colors">
                Panel de Gestión
            </a>

            <div class="hidden sm:flex items-center gap-6 text-md">
                <a href="{{ route('categoria.index') }}" class="font-semibold tracking-wide transition-colors {{ request()->routeIs('categoria.*') ? 'text-red-500' : 'text-gray-300 hover:text-red-400' }}">
                    Categorías
                </a>
                <a href="{{ route('producto.index') }}" class="font-semibold tracking-wide transition-colors {{ request()->routeIs('producto.*') ? 'text-red-500' : 'text-gray-300 hover:text-red-400' }}">
                    Productos
                </a>
                <a href="{{ route('cliente.index') }}" class="font-semibold tracking-wide transition-colors {{ request()->routeIs('cliente.*') ? 'text-red-500' : 'text-gray-300 hover:text-red-400' }}">
                    Clientes
                </a>
            </div>
        </div>

        <a href="{{ route('inicio') }}" class="hover:scale-110 transition-transform" title="Volver al sitio">
            <img src="{{ asset('img/logo-letras.png') }}" alt="GhostCaps" class="h-20 w-auto">
        </a>

    </nav>

    <main class="p-6 max-w-7xl mx-auto">
        @if (session('mensaje'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 mb-4 rounded">
                {{ session('mensaje') }}
            </div>
        @endif

        @yield('contenido')
    </main>

</body>
</html>