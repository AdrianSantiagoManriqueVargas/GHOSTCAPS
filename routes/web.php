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
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\AuthController;
use App\Models;

Route::get('/', function () {

    $categoriasInicio = Categoria::whereIn('id', Producto::select('id_categoria'))
        ->orderBy('nombre_categoria')
        ->get()
        ->map(function ($categoria) {
            $imagenPropia = 'img/categorias/' . Str::slug($categoria->nombre_categoria) . '.jpg';

            $productoConImagen = Producto::with('imagen_producto')
                ->where('id_categoria', $categoria->id)
                ->whereHas('imagen_producto')
                ->orderByDesc('destacado')
                ->latest()
                ->first();

            $imagenProducto = $productoConImagen?->imagen_producto->first()?->url_imagen;

            return [
                'id' => $categoria->id,
                'nombre' => $categoria->nombre_categoria,
                'descripcion' => $categoria->descripcion_categoria,
                'imagen' => File::exists(public_path($imagenPropia))
                    ? asset($imagenPropia)
                    : ($imagenProducto ? asset('storage/' . $imagenProducto) : null),
            ];
        });

    $destacados = Producto::with(['categoria', 'imagen_producto'])->latest()->take(8)->get();

    return view('welcome', compact('categoriasInicio', 'destacados'));
})->name('inicio');

// RUTAS PARA LA GESTION DE PRODUCTOS

Route::middleware('auth')->prefix('gestion')->group(function () {
    
    Route::get('/', function () {
        return view('gestion.index', [
            'totalProductos'    => \App\Models\Producto::count(),
            'totalCategorias'   => \App\Models\Categoria::count(),
            'totalClientes'     => \App\Models\Cliente::count(),
            'totalPedidos'      => \App\Models\Pedido::count(),
            'productosStockBajo' => \App\Models\Producto::with(['imagen_producto', 'categoria'])
                                        ->where('stock', '<=', 2)
                                        ->orderBy('stock')
                                        ->get(),
            'ultimosPedidos'    => \App\Models\Pedido::with('cliente')
                                        ->latest()
                                        ->take(5)
                                        ->get(),
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

Route::view('nosotros', 'nosotros')->name('nosotros');

// CARRITO TEMPORAL

Route::post('carrito/agregar/{producto}', [CarritoController::class, 'store'])->name('carrito.store');
Route::get('carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::delete('carrito/eliminar/{producto}', [CarritoController::class, 'destroy'])->name('carrito.destroy');
Route::put('carrito/actualizar/{producto}', [CarritoController::class, 'update'])->name('carrito.update');
Route::post('carrito/comprar/{producto}', [CarritoController::class, 'comprarAhora'])->name('carrito.comprarAhora');

// CHECKOUT

Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// AUTH

Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.entrar')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');