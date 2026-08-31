<?php

use App\Http\Controllers\CatalogoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ImagenProductoController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categoria', CategoriaController::class);

Route::resource('producto', ProductoController::class);

Route::delete('imagenproducto/{id}', [ImagenProductoController::class, 'destroy'])->name('imagenproducto.destroy');

Route::get('catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
