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
        $productos = $this->productoservice->index();
        return view('catalogo.index', compact('productos'));
    }
}