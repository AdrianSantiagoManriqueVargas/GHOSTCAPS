<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutStoreRequest;
use App\Services\PedidoService;
use App\Services\CarritoService;
use App\Services\ClienteService;
use App\Services\DetallePedidoService;
use App\Services\ProductoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{

    private CarritoService $carritoservice;
    private ClienteService $clienteservice;
    private PedidoService $pedidoservice;
    private DetallePedidoService $detallepedidoservice;
    private ProductoService $productoservice;

    public function __construct(CarritoService $carritoservice, ClienteService $clienteservice, PedidoService $pedidoservice, DetallePedidoService $detallepedidoservice, ProductoService $productoservice)
    {
        $this->carritoservice = $carritoservice;
        $this->clienteservice = $clienteservice;
        $this->pedidoservice = $pedidoservice;
        $this->detallepedidoservice = $detallepedidoservice;
        $this->productoservice = $productoservice;
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
        // Trae los productos del carrito con sus cantidades y el total
        $detalle = $this->carritoservice->obtenerDetallado();

        // Si el carrito está vacío, no se crea nada: vuelve al carrito
        if (empty($detalle['items'])) {
            return redirect()->route('carrito.index');
        }

        // Cuentas del pedido
        $subtotal = $detalle['total'];
        $costoEnvio = config('tienda.costo_envio');
        $total = $subtotal + $costoEnvio;

        // TRANSACCIÓN: o se guarda todo junto (incluido el descuento de stock), o nada
        $pedido = DB::transaction(function () use ($request, $detalle, $subtotal, $costoEnvio, $total) {

            // 1. DESCONTAR STOCK de todo el carrito (si algo no alcanza, lanza error y se deshace todo)
            $this->productoservice->descontarStockCarrito($detalle['items']);

            // 2. CLIENTE: busca si ya existe uno con ese número de documento
            $clienteExistente = $this->clienteservice->buscarPorDocumento($request->validated('numero_documento'));

            if ($clienteExistente) {
                // SEGURIDAD: si la cédula existe pero con otro correo, no se sobrescriben datos ajenos
                if (strtolower($clienteExistente->correo_cliente) !== strtolower($request->validated('correo_cliente'))) {
                    throw ValidationException::withMessages([
                        'numero_documento' => 'Este número de documento ya está registrado con otro correo electrónico. Por favor verifica tus datos.'
                    ]);
                }

                // Mismo correo: es la misma persona, se actualizan sus datos
                $cliente = $this->clienteservice->update($clienteExistente->id, $request->validated());
            } else {
                // Cliente nuevo
                $cliente = $this->clienteservice->store($request->validated());
            }

            // 3. PEDIDO: texto de WhatsApp y registro del pedido como "Pendiente"
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

            // 4. DETALLE: una línea por producto, guardando el precio del momento
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

        // Todo se guardó bien: se vacía el carrito (está en la sesión, por eso va afuera)
        $this->carritoservice->vaciar();

        // Correo de aviso al administrador (si falla, no rompe la compra)
        $this->pedidoservice->notificarNuevoPedido($pedido->id);

        // El id va en la sesión y no en la URL, para que nadie vea pedidos ajenos
        session(['pedido_confirmado' => $pedido->id]);

        return redirect()->route('checkout.resumen');
    }

    public function resumen()
    {
        // pull() obtiene el ID y lo borra de la sesión para que nadie más pueda reabrir los datos
        $idPedido = session()->pull('pedido_confirmado');

        if (!$idPedido) {
            return redirect()->route('inicio');
        }

        $pedido = $this->pedidoservice->buscarConDetalle($idPedido);

        $numeroWhatsapp = config('services.whatsapp.numero');
        $linkWhatsapp = 'https://wa.me/' . $numeroWhatsapp . '?text=' . rawurlencode($pedido->mensaje_whatsapp);

        return view('checkout.resumen', compact('pedido', 'linkWhatsapp'));
    }
}