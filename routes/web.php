<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CatalogoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ColorProductoController;
use App\Http\Controllers\ImagenProductoController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use App\Models;

Route::get('/', function () {

    $categoriasInicio = [
        [
            'nombre' => 'Gorras clásicas',
            'descripcion' => 'Estilo para todos los días',
            'imagen' => 'img/categorias/gorras-clasicas.jpg',
            'fondo' => 'bg-stone-200',
        ],
        [
            'nombre' => 'Gorras urbanas',
            'descripcion' => 'Destaca con tu estilo',
            'imagen' => 'img/categorias/gorras-urbanas.jpg',
            'fondo' => 'bg-zinc-300',
        ],
        [
            'nombre' => 'Ediciones especiales',
            'descripcion' => 'Diseños que no pasan desapercibidos',
            'imagen' => 'img/categorias/ediciones-especiales.jpg',
            'fondo' => 'bg-neutral-200',
        ],
    ];

    $destacados = Producto::with(['categoria', 'imagen_producto'])->latest()->take(8)->get();

    return view('welcome', compact('categoriasInicio', 'destacados'));
})->name('inicio');

// RUTAS PARA LA GESTION DE PRODUCTOS

Route::prefix('gestion')->group(function () {

    Route::get('/', function () {
        return view('gestion.index', [
            'totalProductos' => \App\Models\Producto::count(),
            'totalCategorias' => \App\Models\Categoria::count(),
            'totalClientes' => \App\Models\Cliente::count(),
            'totalPedidos' => \App\Models\Pedido::count(),
        ]);
    })->name('gestion.index');

    Route::resource('categoria', CategoriaController::class);
    Route::resource('producto', ProductoController::class);
    Route::delete('imagenproducto/{id}', [ImagenProductoController::class, 'destroy'])->name('imagenproducto.destroy');
    Route::delete('colorproducto/{id}', [ColorProductoController::class, 'destroy'])->name('colorproducto.destroy');
    Route::resource('cliente', ClienteController::class);
});

// RUTAS PUBLICAS

Route::get('catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('catalogo/producto/{id}', [CatalogoController::class, 'show'])->name('catalogo.producto');

// CARRITO TEMPORAL

Route::post('carrito/agregar/{producto}', [CarritoController::class, 'store'])->name('carrito.store');
Route::get('carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::delete('carrito/eliminar/{producto}', [CarritoController::class, 'destroy'])->name('carrito.destroy');
Route::put('carrito/actualizar/{producto}', [CarritoController::class, 'update'])->name('carrito.update');
Route::post('carrito/comprar/{producto}', [CarritoController::class, 'comprarAhora'])->name('carrito.comprarAhora');

// CHECKOUT

Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');