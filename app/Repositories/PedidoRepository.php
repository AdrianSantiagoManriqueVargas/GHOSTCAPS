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

    public function indexPaginado(int $pagina = 10, ?string $estado = null)
    {
        $query = Pedido::with('cliente')->latest();

        if ($estado) {
            $query->where('estado_pedido', $estado);
        }

        return $query->paginate($pagina)->withQueryString();
    }

    public function actualizarEstado(int $id, string $estado)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update(['estado_pedido' => $estado]);
        return $pedido;
    }
}