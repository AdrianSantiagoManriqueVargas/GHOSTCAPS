@extends('layouts.app')

@section('titulo')
    Nosotros | GhostCaps
@endsection

@section('contenido')

<div class="bg-neutral-900 text-white">

    {{-- INTRODUCCIÓN --}}
    <section class="max-w-7xl mx-auto px-4 py-16 sm:py-24 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        <div class="text-center md:text-left">

            <p class="text-base uppercase tracking-[0.3em] text-gray-400">Nosotros</p>

            <h1 class="font-marker text-5xl lg:text-6xl leading-tight tracking-wide text-white mt-4">
                Somos ese amigo que te lleva a la <span class="text-red-500">cima.</span>
            </h1>

            <p class="mt-6 text-lg sm:text-xl text-gray-300 leading-8 max-w-md mx-auto md:mx-0">
                GhostCaps es ese amigo genial que siempre llega con una gorra y un outfit perfecto para cualquier plan, desde salir con amigos hasta pasear por la ciudad.
            </p>

            <p class="mt-8 font-marker text-3xl sm:text-4xl tracking-wide text-red-500 md:border-l-4 md:border-red-600 md:pl-4">
                ¡Vive en la cima!
            </p>

        </div>

        <div class="flex justify-center md:justify-end">
            @if (File::exists(public_path('img/logo.png')))
                <img src="{{ asset('img/logo.png') }}" alt="GhostCaps" class="w-64 sm:w-80 lg:w-96 h-auto">
            @else
                <p class="p-4 text-gray-500">Sin imagen</p>
            @endif
        </div>

    </section>

    {{-- ASÍ SOMOS --}}
    <section class="max-w-7xl mx-auto px-4 pb-16 sm:pb-24">

        <div class="text-center mb-10">
            <p class="text-base uppercase tracking-[0.3em] text-gray-400">Comunicación de marca</p>
            <h2 class="font-marker text-4xl sm:text-5xl tracking-wide text-white mt-3">Así somos</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-neutral-800 border border-white/10 p-8 transition-all duration-100 ease-in-out hover:scale-105">
                <p class="font-marker text-5xl text-red-500">01</p>
                <h3 class="font-marker text-2xl tracking-wide text-white mt-4">Arquetipo</h3>
                <p class="mt-3 text-gray-300 leading-7">
                    GhostCaps combina los arquetipos del Héroe y el Amigo: te da consejos para destacar y te incluye en su grupo de amigos para vivir en la cima.
                </p>
            </div>

            <div class="bg-neutral-800 border border-white/10 p-8 transition-all duration-100 ease-in-out hover:scale-105">
                <p class="font-marker text-5xl text-red-500">02</p>
                <h3 class="font-marker text-2xl tracking-wide text-white mt-4">Tono</h3>
                <p class="mt-3 text-gray-300 leading-7">
                    Habla como un amigo súper genial y divertido, con energía que te anima a ser tú mismo. Usa un lenguaje sencillo, vibrante y con palabras callejeras, siempre positivo.
                </p>
            </div>

            <div class="bg-neutral-800 border border-white/10 p-8 transition-all duration-100 ease-in-out hover:scale-105">
                <p class="font-marker text-5xl text-red-500">03</p>
                <h3 class="font-marker text-2xl tracking-wide text-white mt-4">Personalidad</h3>
                <p class="mt-3 text-gray-300 leading-7">
                    Valiente, auténtica y amigable, siempre preparada para hacer que tu estilo brille en cualquier momento, inspirando confianza y celebrando el estilo de cada persona.
                </p>
            </div>

        </div>

    </section>

</div>

@endsection