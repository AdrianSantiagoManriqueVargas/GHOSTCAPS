<?php

namespace App\Repositories;
use App\Models\Producto;

class ProductoRepository{

    public function index()
    {
        return Producto::with('categoria')->get();
    }

    public function store(array $data)
    {
        Producto::create($data);
    }

    public function show()
    {
        
    }

    public function edit(int $id)
    {
        $producto = Producto::findorfail($id);
        return $producto;
    }

    public function update(int $id, array $data)
    {
        $producto = Producto::findorfail($id);
        $producto->update($data);
    }

    public function destroy(int $id)
    {
        Producto::destroy($id);
    }

}