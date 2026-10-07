<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión - @yield('titulo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-gray-900 text-white px-6 py-3 flex gap-6 items-center">
        <a href="{{ route('gestion.index') }}" class="font-bold">Panel de Gestión</a>
        <a href="{{ route('categoria.index') }}" class="hover:text-gray-300">Categorías</a>
        <a href="{{ route('producto.index') }}" class="hover:text-gray-300">Productos</a>
        <a href="{{ route('cliente.index') }}" class="hover:text-gray-300">Clientes</a>
        <a href="{{ route('inicio') }}" class="ml-auto text-sm text-gray-400 hover:text-white">Ver sitio</a>
    </nav>

    <main class="p-6">
        @if (session('mensaje'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
                {{ session('mensaje') }}
            </div>
        @endif

        @yield('contenido')
    </main>

</body>
</html>