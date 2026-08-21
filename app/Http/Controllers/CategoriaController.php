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
        $categoria = $this->categoriaservice->index();
        return view('categoria.index', compact('categoria'));
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
        $this->categoriaservice->destroy($id);
        return redirect()->route('categoria.index');
    }
}
