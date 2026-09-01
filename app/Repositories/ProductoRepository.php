<?php

namespace App\Repositories;
use App\Models\Producto;

class ProductoRepository{

    public function index()
    {
        return Producto::with('categoria', 'imagen_producto')->get();
    }

    public function store(array $data)
    {
        return Producto::create($data);
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

    public function buscarPorNombre(string $nombre, int $excluirId) // Método para buscar productos por nombre, excluyendo un ID específico
    {
        return Producto::where('nombre_producto', $nombre)->where('id', '!=', $excluirId)->get(); // El metodo where permite filtrar los productos por nombre y excluir el producto con el ID especificado (en este caso el mismo producto ya visto)
    }

}