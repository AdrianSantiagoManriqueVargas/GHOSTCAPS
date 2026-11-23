@extends('layouts.gestion')

@section('titulo', 'Cambiar Contraseña | Gestión')

@section('contenido')
<div class="max-w-xl mx-auto py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Seguridad de la Cuenta</h1>
        <p class="text-sm text-gray-500">Actualiza tu contraseña de acceso asegurando que cumpla con las políticas del sistema.</p>
    </div>

    @if (session('success_password'))
        <div class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 text-sm font-semibold text-green-800 flex items-center gap-2">
            <span>✓</span> {{ session('success_password') }}
        </div>
    @endif

    <div class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm">
        <form action="{{ route('perfil.password.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Contraseña Actual --}}
            <div>
                <label for="current_password" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                    Contraseña Actual
                </label>
                <input type="password" 
                       name="current_password" 
                       id="current_password" 
                       required 
                       class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-900 focus:border-black focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10">
                @error('current_password')
                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nueva Contraseña --}}
            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                    Nueva Contraseña
                </label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       required 
                       class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-900 focus:border-black focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10">
                <p class="text-[11px] text-gray-500 mt-1">Mínimo 8 caracteres, con mayúsculas, minúsculas y al menos un número.</p>
                @error('password')
                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirmar Contraseña --}}
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                    Confirmar Nueva Contraseña
                </label>
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation" 
                       required 
                       class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-900 focus:border-black focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/10">
            </div>

            <div class="pt-2">
                <button type="submit" 
                        class="w-full rounded-xl bg-black py-3 text-sm font-bold text-white hover:bg-neutral-800 transition shadow-sm">
                    Actualizar Contraseña
                </button>
            </div>
        </form>
    </div>

</div>
@endsection