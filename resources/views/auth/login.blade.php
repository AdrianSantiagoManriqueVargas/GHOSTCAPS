@extends('layouts.app')

@section('titulo')
    Ingresar | GhostCaps
@endsection

@section('contenido')
    <section class="mx-auto w-full max-w-sm px-4 py-16">

        <h1 class="mb-6 text-center font-marker text-3xl">Ingresar</h1>

        <form method="POST" action="{{ route('login.entrar') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-bold">Correo</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2">
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-bold">Contraseña</label>
                <input type="password" id="password" name="password" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2">
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" class="rounded border-gray-300">
                Mantener sesión iniciada
            </label>

            @error('email')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            <button type="submit"
                class="w-full rounded-full border border-black bg-black px-8 py-3 text-sm font-bold uppercase tracking-widest text-white transition hover:bg-white hover:text-black">
                Entrar
            </button>
        </form>

    </section>
@endsection