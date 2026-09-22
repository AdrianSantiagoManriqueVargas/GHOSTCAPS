<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex flex-col min-h-screen">

    <nav class="sticky top-0 z-10 bg-black text-white grid grid-cols-3 items-center px-10 py-2">

        <a href="{{ route('inicio') }}" class="justify-self-start">
            <img src="{{ asset('img/logo.png') }}" alt="GhostCaps" class="h-20">
        </a>

        <div class="flex gap-6 justify-self-center">
            <a href="{{ route('inicio') }}" class="font-semibold tracking-wider transition-colors hover:text-red-400 {{ request()->routeIs('inicio') ? 'text-red-500' : 'text-white' }} ">
                INICIO
            </a>
            <a href="{{ route('catalogo.index') }}" class="font-semibold tracking-wider transition-colors hover:text-red-400 {{ request()->routeIs('catalogo.index') ? 'text-red-500'   : 'text-white' }}">
                CATALOGO
            </a>
        </div>

        <div></div>

    </nav>

    <main class="flex-1">
        @yield('contenido')
    </main>

    <footer class="bg-black text-white px-10 py-5">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-6">

            <img src="{{ asset('img/logo-letras.png') }}" alt="GhostCaps" class="h-20">

            <div class="text-sm text-center sm:text-right">
                <p>contacto@gmail.com</p>
                <p>+57 3172126545</p>
                <p>+57 3112323435</p>
            </div>
            
        </div>
    </footer>

</body>
</html>