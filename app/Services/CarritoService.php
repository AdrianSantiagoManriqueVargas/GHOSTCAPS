<?php

namespace App\Services;
use Illuminate\Validation\ValidationException;

class CarritoService{

    private ProductoService $productoservice;

    public function __construct(ProductoService $productoservice)
    {
        $this->productoservice = $productoservice;
    }

    public function agregar(int $idProducto): void
    {
        $carrito = session('carrito', []);

        // Cuántas unidades de este producto ya hay en el carrito y cuántas existen realmente
        $cantidadEnCarrito = $carrito[$idProducto] ?? 0;
        $stock = $this->productoservice->stockActual($idProducto);

        // Producto agotado: no se puede agregar
        if ($stock <= 0) {
            throw ValidationException::withMessages([
                'carrito' => 'Este producto está agotado por el momento.'
            ]);
        }

        // Ya hay en el carrito todas las unidades disponibles: no se puede sumar otra
        if ($cantidadEnCarrito + 1 > $stock) {
            throw ValidationException::withMessages([
                'carrito' => "Ya tienes en tu carrito todas las unidades disponibles ({$stock})."
            ]);
        }

        // Si el producto ya está en el carrito suma 1; si no, lo agrega con cantidad 1
        $carrito[$idProducto] = $cantidadEnCarrito + 1;

        session(['carrito' => $carrito]);
    }

    public function obtener(){
        return session('carrito', []);
    }

    public function eliminar(int $idProducto){
        $carrito = session('carrito', []);
        unset($carrito[$idProducto]);
        session(['carrito' => $carrito]);
    }

    public function actualizar(int $idProducto, int $cantidad): void
    {
        $carrito = session('carrito', []);

        // Si el producto no está en el carrito, no hay nada que actualizar
        if (!isset($carrito[$idProducto])) {
            return;
        }

        // No se permite pedir más unidades de las que hay
        $stock = $this->productoservice->stockActual($idProducto);

        if ($cantidad > $stock) {
            throw ValidationException::withMessages([
                'carrito' => "Solo hay {$stock} unidades disponibles de este producto."
            ]);
        }

        $carrito[$idProducto] = $cantidad;

        session(['carrito' => $carrito]);
    }  

    public function vaciar(){
        session()->forget('carrito');
    }

    public function obtenerDetallado(): array
    {
        $carrito = $this->obtener();

        $items = [];
        foreach ($carrito as $idProducto => $cantidad) {
            $producto = $this->productoservice->edit($idProducto);
            $items[] = [
                'producto' => $producto,
                'cantidad' => $cantidad,
                'subtotal' => $producto->precio * $cantidad,
            ];
        }

        $total = array_sum(array_column($items, 'subtotal'));

        return [
            'items' => $items,
            'total' => $total,
        ];
    }

    public function totalUnidades(): int
    {
        return array_sum($this->obtener());
    }
}