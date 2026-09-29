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

    public function index()
    {
        $productos = $this->productoservice->indexPaginado(16);
        return view('Catalogo.index', compact('productos'));
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