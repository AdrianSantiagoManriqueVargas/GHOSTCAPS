<?php

namespace App\Services;

class CarritoService{

    public function agregar(int $idProducto){
        $carrito = session('carrito', []);

        // Si el producto ya está en el carrito, le suma 1 a su cantidad
        if (isset($carrito[$idProducto])) {
            $carrito[$idProducto]++;
        } else {
            $carrito[$idProducto] = 1; // Si no esta, lo agrega con cantidad 1
        }

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

    public function actualizar(int $idProducto, int $cantidad){
        $carrito = session('carrito', []);
        if(isset($carrito[$idProducto])){
            $carrito[$idProducto] = $cantidad;
        }
        session(['carrito' => $carrito]);
    }   

}