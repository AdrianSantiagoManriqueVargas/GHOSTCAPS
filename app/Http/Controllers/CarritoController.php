<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarritoUpdateRequest;
use App\Services\CarritoService;
use Illuminate\Http\Request;

class CarritoController extends Controller
{

    private CarritoService $carritoservice;

    public function __construct(CarritoService $carritoservice)
    {
        $this->carritoservice = $carritoservice;
    }

    public function index()
    {
        $detalle = $this->carritoservice->obtenerDetallado();
        $costoEnvio = config('tienda.costo_envio');

        return view('Carrito.index', [
            'items' => $detalle['items'],
            'subtotal' => $detalle['total'],
            'costoEnvio' => $costoEnvio,
            'total' => $detalle['total'] + $costoEnvio,
        ]);
    }

    public function store(int $producto)
    {
        $this->carritoservice->agregar($producto);
        return back();
    }

    public function update(CarritoUpdateRequest $request, int $producto)
    {
        $this->carritoservice->actualizar($producto, $request->validated('cantidad'));
        return back();
    }

    public function destroy(int $producto)
    {
        $this->carritoservice->eliminar($producto);
        return back();
    }

    public function comprarAhora(int $producto)
    {
    $this->carritoservice->agregar($producto);
    return redirect()->route('checkout.create');
    }
}
