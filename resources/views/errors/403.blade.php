@extends('layouts.app')

@section('titulo', '403 - Acceso Denegado | GhostCaps')

@section('contenido')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-16 bg-neutral-50/50">
    <div class="max-w-md w-full text-center">
        <p class="font-marker text-7xl sm:text-8xl text-red-600 leading-none">403</p>
        <h1 class="font-marker text-2xl sm:text-3xl text-neutral-900 mt-4 tracking-wide">
            Zona Restringida
        </h1>
        <p class="mt-3 text-sm text-neutral-600 leading-relaxed">
            No tienes los permisos necesarios para acceder a esta sección de la plataforma.
        </p>

        <div class="mt-8 flex items-center justify-center gap-3">
            <a href="{{ route('inicio') }}" 
               class="rounded-full bg-black px-8 py-3 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-neutral-800 shadow-sm">
                Volver a la tienda
            </a>
        </div>
    </div>
</div>
@endsection