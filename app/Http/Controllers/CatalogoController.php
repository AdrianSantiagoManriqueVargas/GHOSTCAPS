<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductoService;

class CatalogoController extends Controller
{

    private ProductoService $productoservice;

    public function __construct(ProductoService $productoservice){
        $this->productoservice = $productoservice;
    }

    public function index(Request $request)
    {
        $request->validate([
            'precio_min'   => 'nullable|numeric|min:0',
            'precio_max'   => 'nullable|numeric|min:0',
            'colores'      => 'nullable|array',
            'colores.*'    => 'string|max:50',
            'categorias'   => 'nullable|array',
            'categorias.*' => 'integer',
        ]);

        $filtros = array_filter($request->only(['precio_min', 'precio_max', 'colores', 'categorias']));

        $productos = $this->productoservice->indexPaginado(16, $filtros);
        $colores = $this->productoservice->coloresDisponibles();
        $categorias = $this->productoservice->categoriasDisponibles();

        $coloresSeleccionados = array_map('strtolower', $filtros['colores'] ?? []);
        $categoriasSeleccionadas = array_map('intval', $filtros['categorias'] ?? []);

        return view('Catalogo.index', compact(
            'productos', 'filtros', 'colores', 'coloresSeleccionados', 'categorias', 'categoriasSeleccionadas'
        ));
    }

    public function show(Request $request, int $id)
    {
        $producto = $this->productoservice->edit($id);
        $variantesColor = $this->productoservice->variantesColor($producto);
        $indice = (int) $request->query('img', 0);
        $imagenInfo = $this->productoservice->obtenerImagenActual($producto, $indice);

        return view('catalogo.producto', array_merge(compact('producto', 'variantesColor'), $imagenInfo));
    }
}