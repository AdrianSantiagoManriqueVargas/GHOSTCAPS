<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CatalogoIndexRequest;
use App\Services\ProductoService;

class CatalogoController extends Controller
{

    private ProductoService $productoservice;

    public function __construct(ProductoService $productoservice){
        $this->productoservice = $productoservice;
    }

    public function index(CatalogoIndexRequest $request)
    {
        // validated() trae solo los campos que pasaron las reglas; array_filter quita los vacíos
        $filtros = array_filter($request->validated());

        $productos = $this->productoservice->indexPaginado(16, $filtros);
        $colores = $this->productoservice->coloresDisponibles();
        $categorias = $this->productoservice->categoriasDisponibles();

        $coloresSeleccionados = array_map('strtolower', $filtros['colores'] ?? []);
        $categoriasSeleccionadas = array_map('intval', $filtros['categorias'] ?? []);
        $tituloOrden = $this->productoservice->tituloOrden($filtros['orden'] ?? null);

        return view('Catalogo.index', compact(
            'productos', 'filtros', 'colores', 'coloresSeleccionados',
            'categorias', 'categoriasSeleccionadas', 'tituloOrden'
        ));
    }

    public function show(Request $request, int $id)
    {
        $producto = $this->productoservice->edit($id);
        $variantesColor = $this->productoservice->variantesColor($producto);
        $relacionados = $this->productoservice->productosRelacionados($producto);
        $indice = (int) $request->query('img', 0);
        $imagenInfo = $this->productoservice->obtenerImagenActual($producto, $indice);

        return view('catalogo.producto', array_merge(compact('producto', 'variantesColor', 'relacionados'), $imagenInfo));
    }
}