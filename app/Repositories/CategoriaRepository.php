<?php

namespace App\Repositories;
use App\Models\Categoria;

class CategoriaRepository{

    public function index()
    {
        return $categoria = Categoria::all();
    }

    public function store(array $data)
    {
        Categoria::create($data);
    }

    public function show()
    {
        
    }

    public function edit(int $id)
    {
        $categoria = Categoria::findorfail($id);
        return $categoria;
    }

    public function update(int $id, array $data)
    {
        $categoria = Categoria::findorfail($id);
        $categoria->update($data);
    }

    public function destroy(int $id)
    {
        Categoria::destroy($id);
    }

}