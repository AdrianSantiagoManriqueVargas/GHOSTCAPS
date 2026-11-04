<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutStoreRequest;
use App\Services\PedidoService;
use App\Services\CarritoService;
use App\Services\ClienteService;
use App\Services\DetallePedidoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    private CarritoService $carritoservice;
    private ClienteService $clienteservice;
    private PedidoService $pedidoservice;
    private DetallePedidoService $detallepedidoservice;

    public function __construct(CarritoService $carritoservice, ClienteService $clienteservice, PedidoService $pedidoservice, DetallePedidoService $detallepedidoservice)
    {
        $this->carritoservice = $carritoservice;
        $this->clienteservice = $clienteservice;
        $this->pedidoservice = $pedidoservice;
        $this->detallepedidoservice = $detallepedidoservice;
    }

    public function create()
    {
        $detalle = $this->carritoservice->obtenerDetallado();
        $subtotal = $detalle['total'];
        $costoEnvio = config('tienda.costo_envio');
        $total = $subtotal + $costoEnvio;

        return view('checkout.create', [
            'items' => $detalle['items'],
            'subtotal' => $subtotal,
            'costoEnvio' => $costoEnvio,
            'total' => $total,
            'ciudades' => config('tienda.ciudades'),
        ]);
    }

    public function store(CheckoutStoreRequest $request)
    {
        $detalle = $this->carritoservice->obtenerDetallado();

        if (empty($detalle['items'])) {
            return redirect()->route('carrito.index');
        }

        $subtotal = $detalle['total'];
        $costoEnvio = config('tienda.costo_envio');
        $total = $subtotal + $costoEnvio;

        $pedido = DB::transaction(function () use ($request, $detalle, $subtotal, $costoEnvio, $total) {

            $cliente = $this->clienteservice->buscarPorDocumento($request->validated('numero_documento'));

            if ($cliente) {
                $cliente = $this->clienteservice->update($cliente->id, $request->validated());
            } else {
                $cliente = $this->clienteservice->store($request->validated());
            }

            $mensajeWhatsapp = $this->pedidoservice->mensajeWhatsApp(
                $cliente,
                $detalle['items'],
                $subtotal,
                $costoEnvio,
                $total
            );

            $pedido = $this->pedidoservice->store([
                'estado_pedido' => 'Pendiente',
                'mensaje_whatsapp' => $mensajeWhatsapp,
                'costo_envio' => $costoEnvio,
                'total' => $total,
                'subtotal' => $subtotal,
                'id_cliente' => $cliente->id,
            ]);

            foreach ($detalle['items'] as $item) {
                $this->detallepedidoservice->store([
                    'id_pedido' => $pedido->id,
                    'id_producto' => $item['producto']->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['producto']->precio,
                    'subtotal_detalle' => $item['subtotal'],
                ]);
            }

            return $pedido;
        });

        $this->carritoservice->vaciar();

        $this->pedidoservice->notificarNuevoPedido($pedido->id);

        session(['pedido_confirmado' => $pedido->id]);

        return redirect()->route('checkout.resumen');
    }

    public function resumen()
    {
        $idPedido = session('pedido_confirmado');

        if (!$idPedido) {
            return redirect()->route('inicio');
        }

        $pedido = $this->pedidoservice->buscarConDetalle($idPedido);

        $numeroWhatsapp = config('services.whatsapp.numero');
        $linkWhatsapp = 'https://wa.me/' . $numeroWhatsapp . '?text=' . rawurlencode($pedido->mensaje_whatsapp);

        return view('checkout.resumen', compact('pedido', 'linkWhatsapp'));
    }
}