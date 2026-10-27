<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>

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
<body class="bg-white flex flex-col min-h-screen">

    <nav class="sticky top-0 z-10 bg-black text-white grid grid-cols-3 items-center px-10 py-2">

        <a href="{{ route('inicio') }}" class="justify-self-start hover:scale-125 transition-transform">
            <img src="{{ asset('img/logo.png') }}" alt="GhostCaps" class="h-20">
        </a>

        <div class="flex gap-6 justify-self-center text-lg">
            <a href="{{ route('inicio') }}" class="font-bold tracking-wider transition-colors hover:text-red-400 {{ request()->routeIs('inicio') ? 'text-red-500' : 'text-white' }} ">
                INICIO
            </a>
            <a href="{{ route('nosotros') }}" class="font-bold tracking-wider transition-colors hover:text-red-400 {{ request()->routeIs('nosotros') ? 'text-red-500' : 'text-white' }} ">
                NOSOTROS
            </a>
            <a href="{{ route('catalogo.index') }}" class="font-bold tracking-wider transition-colors hover:text-red-400 {{ request()->routeIs('catalogo.index') ? 'text-red-500'   : 'text-white' }}">
                CATALOGO
            </a>
        </div>

        <div class="justify-self-end relative hover:scale-125 transition-transform">
            <a href="{{ route('carrito.index') }}">
                <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="h-8">
                @if ($totalCarrito > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $totalCarrito }}
                    </span>
                @endif
            </a>
        </div>

    </nav>

    <main class="flex-1">

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('contenido')
    </main>

    <footer class="bg-black text-white px-10 pb-8">
        <div class="max-w-7xl mx-auto border-t border-white/20 pt-10 flex flex-col sm:flex-row justify-between items-center sm:items-start gap-8 text-center sm:text-left">

            <div>
                <h3 class="font-marker text-xl text-red-500 tracking-wide">Contacto</h3>
                <div class="mt-3 space-y-1 text-gray-300">
                    <p>contacto@gmail.com</p>
                    <p>+57 3172126545</p>
                    <p>+57 3112323435</p>
                </div>
            </div>

            <div>
                <h3 class="font-marker text-xl text-red-500 tracking-wide">Síguenos</h3>
                <div class="mt-3 flex flex-col gap-1 text-gray-300">
                    <a href="#" class="transition-colors hover:text-red-500">Instagram</a>
                    <a href="#" class="transition-colors hover:text-red-500">TikTok</a>
                    <a href="https://wa.me/573172126545" target="_blank" rel="noopener" class="transition-colors hover:text-red-500">WhatsApp</a>
                </div>
            </div>

        </div>

        <p class="mt-10 text-center text-xs text-gray-500">
            © {{ date('Y') }} GhostCaps. Todos los derechos reservados.
        </p>
    </footer>

</body>
</html>