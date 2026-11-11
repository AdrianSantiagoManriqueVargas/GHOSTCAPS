<?php

namespace App\Services;

use App\Models\Cliente;
use App\Repositories\PedidoRepository;
use App\Mail\PedidoNuevoMail;
use Illuminate\Support\Facades\Mail;

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
        $mensaje = "*NUEVO PEDIDO - GHOSTCAPS*\n\n";
        $mensaje .= "*Productos solicitados:*\n";

        foreach ($items as $item) {
            $producto = $item['producto'];
            $urlProducto = route('catalogo.producto', $producto->id);

            $mensaje .= "- {$item['cantidad']}x *{$producto->nombre_producto}* ($" . number_format($item['subtotal'], 0, ',', '.') . ")\n";
            $mensaje .= "  Ver producto: {$urlProducto}\n\n";
        }

        $mensaje .= "*Resumen de pago:*\n";
        $mensaje .= "Subtotal: $" . number_format($subtotal, 0, ',', '.') . "\n";
        $mensaje .= "Envio: $" . number_format($costoEnvio, 0, ',', '.') . "\n";
        $mensaje .= "*Total a pagar: $" . number_format($total, 0, ',', '.') . "*\n\n";

        $mensaje .= "*Datos de Envio:*\n";
        $mensaje .= "- Cliente: {$cliente->nombre_cliente}\n";
        $mensaje .= "- Telefono: {$cliente->telefono_cliente}\n";
        $mensaje .= "- Destino: {$cliente->direccion}, {$cliente->ciudad}\n";

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

    public function notificarNuevoPedido(int $idPedido): void
    {
        $correo = config('tienda.correo_admin');

        if (!$correo) {
            return;
        }

        try {
            $pedido = $this->buscarConDetalle($idPedido);
            Mail::to($correo)->send(new PedidoNuevoMail($pedido));
        } catch (\Throwable $e) {
            report($e);
        }
    }
}