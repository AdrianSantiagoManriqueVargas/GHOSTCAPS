@extends('layouts.app')

@section('titulo', '419 - Sesión Expirada | GhostCaps')

@section('contenido')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-16 bg-neutral-50/50">
    <div class="max-w-md w-full text-center">
        <p class="font-marker text-7xl sm:text-8xl text-neutral-400 leading-none">419</p>
        <h1 class="font-marker text-2xl sm:text-3xl text-neutral-900 mt-4 tracking-wide">
            Tu sesión ha expirado
        </h1>
        <p class="mt-3 text-sm text-neutral-600 leading-relaxed">
            La página estuvo inactiva por mucho tiempo y se cerró por tu propia seguridad. Recarga para continuar con tu compra.
        </p>

        <div class="mt-8 flex items-center justify-center gap-3">
            <button onclick="window.location.reload()" 
                    class="rounded-full bg-red-600 px-8 py-3 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-red-700 shadow-sm">
                Recargar Página
            </button>
        </div>
    </div>
</div>
@endsection