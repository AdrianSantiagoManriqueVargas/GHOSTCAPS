<?php

namespace App\Services;

use App\Repositories\ColorProductoRepository;

class ColorProductoService
{
    private ColorProductoRepository $colorproductorepository;

    public function __construct(ColorProductoRepository $colorproductorepository)
    {
        $this->colorproductorepository = $colorproductorepository;
    }

    public function store(array $data)
    {
        return $this->colorproductorepository->store($data);
    }

    public function destroy(int $id)
    {
        return $this->colorproductorepository->destroy($id);
    }
}