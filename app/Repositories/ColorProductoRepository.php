<?php

namespace App\Repositories;

use App\Models\ColorProducto;

class ColorProductoRepository
{
    public function index()
    {
        return ColorProducto::with('producto')->get();
    }

    public function store(array $data)
    {
        return ColorProducto::create($data);
    }

    public function destroy(int $id)
    {
        $color = ColorProducto::findorfail($id); # trae el registro

        return $color->delete(); # borra el registro de la base de datos
    }
}