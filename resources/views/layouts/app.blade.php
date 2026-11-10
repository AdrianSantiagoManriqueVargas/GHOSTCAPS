<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Permanent+Marker&display=swap" rel="stylesheet">

    {{-- Animaciones propias --}}
    <link rel="stylesheet" href="{{ asset('css/animaciones.css') }}">

    {{-- Marca que JavaScript está activo (para la aparición al bajar) --}}
    <script>document.documentElement.classList.add('js')</script>

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

    {{-- Scripts propios de cada página (deben ir antes de Alpine) --}}
    @stack('scripts')

    <script defer src="{{ asset('js/animaciones.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">

    <nav class="sticky top-0 z-20 bg-black text-white">
        <div class="grid grid-cols-[auto_1fr_auto] items-center px-4 py-2 sm:grid-cols-3 sm:px-10">

            {{-- Casilla invisible que controla el menú en móvil --}}
            <input type="checkbox" id="menu-movil" class="peer hidden">

            <a href="{{ route('inicio') }}" class="justify-self-start transition-transform hover:scale-125">
                <img src="{{ asset('img/logo.png') }}" alt="GhostCaps" class="h-12 sm:h-20">
            </a>

            {{-- Links: lista desplegable en móvil, fila centrada en pantalla grande --}}
            <div class="order-last col-span-full mt-2 hidden flex-col border-t border-white/20 peer-checked:flex sm:order-none sm:col-span-1 sm:col-start-2 sm:row-start-1 sm:mt-0 sm:flex sm:flex-row sm:justify-self-center sm:gap-6 sm:border-0">

                <a href="{{ route('inicio') }}" class="py-3 text-center text-sm font-bold tracking-wider transition-colors hover:text-red-400 sm:py-0 sm:text-lg {{ request()->routeIs('inicio') ? 'text-red-500' : 'text-white' }}">
                    INICIO
                </a>
                <a href="{{ route('catalogo.index') }}" class="py-3 text-center text-sm font-bold tracking-wider transition-colors hover:text-red-400 sm:py-0 sm:text-lg {{ request()->routeIs('catalogo.index') ? 'text-red-500' : 'text-white' }}">
                    CATALOGO
                </a>
                @auth
                    <a href="{{ route('gestion.index') }}" class="py-3 text-center text-sm font-bold tracking-wider transition-colors hover:text-red-400 sm:py-0 sm:text-lg {{ request()->is('gestion*') ? 'text-red-500' : 'text-white' }}">
                        GESTIÓN
                    </a>
                @endauth

            </div>

            {{-- Usuario + carrito + botón de las 3 rayitas --}}
            <div class="col-start-3 flex items-center gap-4 justify-self-end">

                @guest
                    <a href="{{ route('login') }}" title="Acceso administrador" aria-label="Acceso administrador" class="transition-transform hover:scale-125">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </a>
                @endguest

                <div class="relative transition-transform hover:scale-125">
                    <a href="{{ route('carrito.index') }}">
                        <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="h-8">
                        @if ($totalCarrito > 0)
                            <span class="absolute -top-2 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white">
                                {{ $totalCarrito }}
                            </span>
                        @endif
                    </a>
                </div>

                <label for="menu-movil" class="cursor-pointer sm:hidden" aria-label="Abrir menú">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </label>

            </div>

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
                    <p>ghostcaps@gmail.com</p>
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