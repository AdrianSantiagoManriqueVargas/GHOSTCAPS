@extends('layouts.app')

@section('titulo', '404 - Página no encontrada | GhostCaps')

@section('contenido')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-16 bg-neutral-50/50">
    <div class="max-w-md w-full text-center">
        <p class="font-marker text-8xl sm:text-9xl text-red-600 leading-none">404</p>
        <h1 class="font-marker text-3xl sm:text-4xl text-neutral-900 mt-4 tracking-wide">
            Te perdiste en el camino
        </h1>
        <p class="mt-3 text-sm text-neutral-600 leading-relaxed">
            La gorra o la página que estás buscando ya no existe, cambió de lugar o nunca estuvo aquí.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ route('catalogo.index') }}" 
               class="w-full sm:w-auto rounded-full bg-black px-7 py-3 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-neutral-800 shadow-sm">
                Explorar Catálogo
            </a>
            <a href="{{ route('inicio') }}" 
               class="w-full sm:w-auto rounded-full border border-neutral-300 bg-white px-7 py-3 text-xs font-bold uppercase tracking-widest text-neutral-800 transition hover:bg-neutral-100">
                Ir al Inicio
            </a>
        </div>
    </div>
</div>
@endsection