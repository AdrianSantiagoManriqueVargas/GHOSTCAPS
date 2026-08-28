<?php

namespace App\Repositories;

use App\Models\ImagenProducto;

class ImagenProductoRepository
{
    public function index()
    {
        return ImagenProducto::with('producto')->get();
    }

    public function store(array $data)
    {
        return ImagenProducto::create($data);
    }

    public function destroy(int $id)
    {
        return ImagenProducto::destroy($id);
    }
}