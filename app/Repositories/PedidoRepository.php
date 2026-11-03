<?php

namespace App\Repositories;

use App\Models\Pedido;

class PedidoRepository
{
    public function store(array $datosPedido)
    {
        return Pedido::create($datosPedido);
    }

    public function buscarConDetalle(int $id)
    {
        return Pedido::with(['cliente', 'detalle_pedido.producto.imagen_producto'])->findOrFail($id);
    }
}