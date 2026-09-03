<?php

namespace App\Http\Controllers;

use App\Services\CarritoService;
use App\Services\ProductoService;
use Illuminate\Http\Request;

class CarritoController extends Controller
{

    private CarritoService $carritoservice;
    private ProductoService $productoservice;

    public function __construct(CarritoService $carritoservice, ProductoService $productoservice)
    {
        $this->carritoservice = $carritoservice;
        $this->productoservice = $productoservice;
    }

    public function index()
    {
        $carrito = $this->carritoservice->obtener();

        $items = [];
        foreach ($carrito as $idProducto => $cantidad){
            $producto = $this->productoservice->edit($idProducto);
            $items[] = [
                'producto' => $producto,
                'cantidad' => $cantidad
            ];
        }

        return view('Carrito.index', compact('items'));
    }

    public function create()
    {
        
    }

    public function store(int $producto)
    {
        $this->carritoservice->agregar($producto);
        return back();
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(int $producto)
    {
        $this->carritoservice->eliminar($producto);
        return back();
    }
}
