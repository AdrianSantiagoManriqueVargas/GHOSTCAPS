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

    public function indexPaginado(int $pagina = 10, ?string $estado = null, ?string $buscar = null)
    {
        $query = Pedido::with('cliente')->latest();

        if ($estado) {
            $query->where('estado_pedido', $estado);
        }

        if ($buscar) {
            // Quita signos # si el usuario busca "#15"
            $termino = ltrim($buscar, '#');

            $query->where(function ($q) use ($termino, $buscar) {
                if (is_numeric($termino)) {
                    $q->orWhere('id', (int) $termino);
                }

                $q->orWhereHas('cliente', function ($qc) use ($buscar) {
                    $qc->where('nombre_cliente', 'like', "%{$buscar}%")
                       ->orWhere('telefono_cliente', 'like', "%{$buscar}%")
                       ->orWhere('numero_documento', 'like', "%{$buscar}%")
                       ->orWhere('ciudad', 'like', "%{$buscar}%");
                });
            });
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