<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión - @yield('titulo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <nav class="bg-gray-900 text-white px-6 py-4 flex gap-6 items-center shadow">
        <a href="{{ route('gestion.index') }}" class="font-bold text-lg">Panel de Gestión</a>
        <a href="{{ route('categoria.index') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Categorías</a>
        <a href="{{ route('producto.index') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Productos</a>
        <a href="{{ route('cliente.index') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Clientes</a>
        <a href="{{ route('inicio') }}" class="ml-auto text-sm text-gray-400 hover:text-white transition-colors">Ver sitio →</a>
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