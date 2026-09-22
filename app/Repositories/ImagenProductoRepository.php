<?php

namespace App\Repositories;

use App\Models\ImagenProducto;
use Illuminate\Support\Facades\Storage;

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
        $imagen = ImagenProducto::findorfail($id); # trae el registro

        Storage::disk('public')->delete($imagen->url_imagen); # borra el archivo fisico

        return $imagen->delete(); #borra el registro de la base de datos
    }
}