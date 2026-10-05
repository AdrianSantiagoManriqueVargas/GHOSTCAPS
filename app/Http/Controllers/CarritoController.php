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

        return view('Carrito.index', [
            'items' => $detalle['items'],
            'total' => $detalle['total'],
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
