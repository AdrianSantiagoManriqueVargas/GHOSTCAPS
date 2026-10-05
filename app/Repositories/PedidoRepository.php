<?php

namespace App\Repositories;

use App\Models\Pedido;

class PedidoRepository
{
    public function store(array $datosPedido)
    {
        return Pedido::create($datosPedido);
    }
}