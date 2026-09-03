<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CatalogoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ImagenProductoController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;

Route::get('/', function () {
    return view('welcome');
});

// RUTAS PARA LA GESTION DE PRODUCTOS

Route::resource('categoria', CategoriaController::class);

Route::resource('producto', ProductoController::class);

Route::delete('imagenproducto/{id}', [ImagenProductoController::class, 'destroy'])->name('imagenproducto.destroy');

// RUTAS PUBLICAS

Route::get('catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');

Route::get('catalogo/producto/{id}', [CatalogoController::class, 'show'])->name('catalogo.producto');

// CARRITO TEMPORAL

Route::post('carrito/agregar/{producto}', [CarritoController::class, 'store'])->name('carrito.store');

Route::get('carrito', [CarritoController::class, 'index'])->name('carrito.index');

Route::delete('carrito/eliminar/{producto}', [CarritoController::class, 'destroy'])->name('carrito.destroy');