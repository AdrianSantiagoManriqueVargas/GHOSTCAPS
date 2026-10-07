<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutStoreRequest;
use App\Services\PedidoService;
use App\Services\CarritoService;
use App\Services\ClienteService;
use App\Services\DetallePedidoService;
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
        return view('checkout.create');
    }

    public function store(CheckoutStoreRequest $request)
    {
        $cliente = $this->clienteservice->buscarPorDocumento($request->validated('numero_documento'));

        if ($cliente) {
            $cliente = $this->clienteservice->update($cliente->id, $request->validated());
        } else {
            $cliente = $this->clienteservice->store($request->validated());
        }

        $detalle = $this->carritoservice->obtenerDetallado();
        $subtotal = $detalle['total'];
        $costoEnvio = config('tienda.costo_envio');
        $total = $subtotal + $costoEnvio;

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

        $this->carritoservice->vaciar();

        $numeroWhatsapp = config('services.whatsapp.numero');

        return redirect()->away('https://wa.me/' . $numeroWhatsapp . '?text=' . urlencode($pedido->mensaje_whatsapp));
    }
}
