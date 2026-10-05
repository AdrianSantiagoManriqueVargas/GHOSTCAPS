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
            $mensaje .= "- {$item['cantidad']}x {$item['producto']->nombre_producto} (\${$item['subtotal']})\n";
        }

        $mensaje .= "\nSubtotal: \${$subtotal}\n";
        $mensaje .= "Envio: \${$costoEnvio}\n";
        $mensaje .= "Total: \${$total}\n\n";
        $mensaje .= "Datos del cliente:\n";
        $mensaje .= "Nombre: {$cliente->nombre_cliente}\n";
        $mensaje .= "Telefono: {$cliente->telefono_cliente}\n";
        $mensaje .= "Direccion: {$cliente->direccion}, {$cliente->ciudad}\n";

        return $mensaje;
    }
}