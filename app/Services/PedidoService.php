<?php

namespace App\Services;

use App\Models\Cliente;
use App\Repositories\PedidoRepository;

class PedidoService
{
    private PedidoRepository $pedidorepository;

    public function __construct(PedidoRepository $pedidorepository)
    {
        $this->pedidorepository = $pedidorepository;
    }

    public function store(array $datosPedido)
    {
        return $this->pedidorepository->store($datosPedido);
    }

    public function mensajeWhatsapp(Cliente $cliente, array $items, float $subtotal, float $costoEnvio, float $total): string
    {
        $mensaje = "Hola, quiero confirmar mi pedido:\n\n";

        foreach ($items as $item) {
            $mensaje .= "- {$item['cantidad']}x {$item['producto']->nombre_producto} ($" . number_format($item['subtotal'], 0, ',', '.') . ")\n";
        }

        $mensaje .= "\nSubtotal: $" . number_format($subtotal, 0, ',', '.') . "\n";
        $mensaje .= "Envio: $" . number_format($costoEnvio, 0, ',', '.') . "\n";
        $mensaje .= "Total: $" . number_format($total, 0, ',', '.') . "\n\n";
        $mensaje .= "Datos del cliente:\n";
        $mensaje .= "Nombre: {$cliente->nombre_cliente}\n";
        $mensaje .= "Telefono: {$cliente->telefono_cliente}\n";
        $mensaje .= "Direccion: {$cliente->direccion}, {$cliente->ciudad}\n";

        return $mensaje;
    }

    public function buscarConDetalle(int $id)
    {
        return $this->pedidorepository->buscarConDetalle($id);
    }

    public function indexPaginado(int $pagina = 10, ?string $estado = null)
    {
        return $this->pedidorepository->indexPaginado($pagina, $estado);
    }

    public function actualizarEstado(int $id, string $estado)
    {
        return $this->pedidorepository->actualizarEstado($id, $estado);
    }
}