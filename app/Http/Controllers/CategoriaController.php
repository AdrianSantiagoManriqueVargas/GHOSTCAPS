<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaStoreRequest;
use App\Http\Requests\CategoriaUpdateRequest;
use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    private CategoriaService $categoriaservice;

    public function __construct(CategoriaService $categoriaservice){
        $this->categoriaservice = $categoriaservice;
    }

    public function index()
    {
        $categorias = $this->categoriaservice->indexPaginado(10);
        return view('categoria.index', compact('categorias'));
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(CategoriaStoreRequest $request)
    {
        $this->categoriaservice->store($request->validated());
        return redirect()->route('categoria.index');
    }

    public function show()
    {
        
    }

    public function edit(int $id)
    {
        $categoria = $this->categoriaservice->edit($id);
        return view('categoria.edit', compact('categoria'));
    }

    public function update(int $id, CategoriaUpdateRequest $request)
    {
        $this->categoriaservice->update($id, $request->validated());
        return redirect()->route('categoria.index');
    }

    public function destroy(int $id)
    {
        $categoria = $this->categoriaservice->edit($id);
        $totalProductos = $categoria->producto()->count();

        // verificar si tiene gorras

        if ($totalProductos > 0) {
            return redirect()->route('categoria.index')->with(
                'error', 
                "No puedes eliminar la categoría \"{$categoria->nombre_categoria}\" porque tiene {$totalProductos} gorra(s) asignada(s). Primero debes reasignar o eliminar esos productos."
            );
        }
        $this->categoriaservice->destroy($id);
        return redirect()->route('categoria.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
