<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Producto;
use App\Repositories\PedidoRepository;
use App\Mail\PedidoNuevoMail;
use App\Services\ProductoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

class PedidoService
{
    private PedidoRepository $pedidorepository;
    private ProductoService $productoservice;

    public function __construct(PedidoRepository $pedidorepository, ProductoService $productoservice)
    {
        $this->pedidorepository = $pedidorepository;
        $this->productoservice = $productoservice;
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

    public function actualizarEstado(int $id, string $nuevoEstado)
    {
        $pedido = $this->pedidorepository->buscarConDetalle($id);
        $estadoAnterior = $pedido->estado_pedido;

        // Si el estado no cambia, no se toca el stock
        if ($estadoAnterior === $nuevoEstado) {
            return $pedido;
        }

        // Transacción: el cambio de estado y el stock se guardan juntos, o no se guarda nada
        DB::transaction(function () use ($pedido, $estadoAnterior, $nuevoEstado) {

            // CASO 1: pasa a "Cancelado" → devolver las unidades al stock
            if ($nuevoEstado === 'Cancelado' && $estadoAnterior !== 'Cancelado') {
                foreach ($pedido->detalle_pedido as $detalle) {
                    $this->productoservice->devolverStock($detalle->id_producto, $detalle->cantidad);
                }
            }

            // CASO 2: sale de "Cancelado" → volver a descontar, solo si todavía hay stock
            if ($estadoAnterior === 'Cancelado' && $nuevoEstado !== 'Cancelado') {
                foreach ($pedido->detalle_pedido as $detalle) {
                    if (!$this->productoservice->descontarStock($detalle->id_producto, $detalle->cantidad)) {
                        // No alcanza: se lanza un error y la transacción deshace lo ya descontado
                        throw ValidationException::withMessages([
                            'estado_pedido' => 'No se puede reactivar el pedido: no hay stock suficiente de "'
                                . ($detalle->producto?->nombre_producto ?? 'un producto') . '".'
                        ]);
                    }
                }
            }

            // Se actualiza el estado del pedido
            $pedido->update(['estado_pedido' => $nuevoEstado]);
        });

        return $pedido;
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