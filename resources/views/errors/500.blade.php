<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Error del Servidor | GhostCaps</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Permanent+Marker&display=swap" rel="stylesheet">
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
<body class="bg-neutral-900 text-white min-h-screen flex items-center justify-center px-4 py-12 antialiased">
    <div class="max-w-md w-full text-center">
        <p class="font-marker text-8xl text-red-600 leading-none">500</p>
        <h1 class="font-marker text-3xl text-white mt-4 tracking-wide">
            Algo falló en el servidor
        </h1>
        <p class="mt-3 text-sm text-neutral-400 leading-relaxed">
            Tuvimos un problema técnico momentáneo. Nuestro equipo ya fue notificado y estamos trabajando para solucionarlo.
        </p>

        <div class="mt-8 flex items-center justify-center gap-3">
            <a href="/" 
               class="rounded-full bg-red-600 px-8 py-3 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-red-700 shadow-lg">
                Volver al Inicio
            </a>
        </div>
    </div>
</body>
</html>