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
                    Gestion Categoria
                </a>
                <a href="{{ route('producto.index') }}" class="">
                    Gestion Producto
                </a>
                <a href="{{ route('catalogo.index') }}" class="">
                    Catalogo
                </a>
            </div>
        </div>
    </div>
@endsection