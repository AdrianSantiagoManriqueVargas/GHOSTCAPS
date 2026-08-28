<?php

namespace App\Services;

use App\Repositories\ImagenProductoRepository;

class ImagenProductoService
{
    private ImagenProductoRepository $imagenproductorepository;

    public function __construct(ImagenProductoRepository $imagenproductorepository)
    {
        $this->imagenproductorepository = $imagenproductorepository;
    }

    public function store(array $data)
    {
        return $this->imagenproductorepository->store($data);
    }

    public function destroy(int $id)
    {
        return $this->imagenproductorepository->destroy($id);
    }
}