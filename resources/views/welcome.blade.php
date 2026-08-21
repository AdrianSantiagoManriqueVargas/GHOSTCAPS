@extends('layouts.app')

@section('titulo')
    Bienvenido
@endsection

@section('contenido')
    <div class="min-h-screen flex items-center justify-center">
        <div class="">
            <h1 class="">Bienvenido</h1>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('categoria.index') }}" class="">
                    Categoria
                </a>
            </div>
        </div>
    </div>
@endsection