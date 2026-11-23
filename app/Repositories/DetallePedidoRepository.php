<?php

namespace App\Repositories;

use App\Models\DetallePedido;

class DetallePedidoRepository
{
    public function store(array $datosDetalle)
    {
        return DetallePedido::create($datosDetalle);
    }
}