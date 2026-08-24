<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoStoreRequest;
use App\Http\Requests\ProductoUpdateRequest;
use App\Services\ProductoService;
use App\Services\CategoriaService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    private ProductoService $productoservice;
    private CategoriaService $categoriaservice;

    public function __construct(ProductoService $productoservice, CategoriaService $categoriaservice){
        $this->productoservice = $productoservice;
        $this->categoriaservice = $categoriaservice;
    }

    public function index()
    {
        $productos = $this->productoservice->index();
        return view('producto.index', compact('productos'));
    }

    public function create()
    {

        $categorias = $this->categoriaservice->index();

        return view('producto.create', compact('categorias'));
    }

    public function store(ProductoStoreRequest $request)
    {
        $this->productoservice->store($request->validated());
        return redirect()->route('producto.index');
    }

    public function show()
    {
        
    }

    public function edit(int $id)
    {
        $producto = $this->productoservice->edit($id);
        return view('producto.edit', compact('producto'));
    }

    public function update(int $id, ProductoUpdateRequest $request)
    {
        $this->productoservice->update($id, $request->validated());
        return redirect()->route('producto.index');
    }

    public function destroy(int $id)
    {
        $this->productoservice->destroy($id);
        return redirect()->route('producto.index');
    }
}
