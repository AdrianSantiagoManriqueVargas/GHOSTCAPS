<?php

namespace App\Services;
use App\Repositories\ProductoRepository;

class ProductoService{

    private ProductoRepository $productorepository;
    private ImagenProductoService $imagenproductoservice;

    public function __construct(ProductoRepository $productorepository, ImagenProductoService $imagenproductoservice){
        $this->productorepository = $productorepository;
        $this->imagenproductoservice = $imagenproductoservice;
    }

    public function index(){
        return $this->productorepository->index();
    }

    public function store(array $dataProducto, array $imagenes){

        $producto = $this->productorepository->store($dataProducto);

        foreach ($imagenes as $imagen){
            $ruta = $imagen->store('productos', 'public');
            $this->imagenproductoservice->store([
                'id_producto' => $producto->id,
                'url_imagen' => $ruta,
            ]);
        }
    }

    public function edit(int $id){
        return $this->productorepository->edit($id);
    }

    public function update(int $id, array $datosProducto, ?array $imagenes = null){
        $this->productorepository->update($id, $datosProducto);

        if ($imagenes) {
            foreach ($imagenes as $imagen) {
                $ruta = $imagen->store('productos', 'public');
                $this->imagenproductoservice->store([
                    'id_producto' => $id,
                    'url_imagen' => $ruta,
                ]);
            }
        }
    }   

    public function destroy(int $id){
        $producto = $this->productorepository->edit($id);

        foreach ($producto->imagen_producto as $imagen) {
            $this->imagenproductoservice->destroy($imagen->id);
        }

        $this->productorepository->destroy($id);
    }
}