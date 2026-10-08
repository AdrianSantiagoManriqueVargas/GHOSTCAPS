<?php

namespace App\Services;

use App\Models\Producto;
use App\Repositories\ProductoRepository;

class ProductoService{

    private ProductoRepository $productorepository;
    private ImagenProductoService $imagenproductoservice;
    private ColorProductoService $colorproductoservice;

    public function __construct(
        ProductoRepository $productorepository,
        ImagenProductoService $imagenproductoservice,
        ColorProductoService $colorproductoservice
    ){
        $this->productorepository = $productorepository;
        $this->imagenproductoservice = $imagenproductoservice;
        $this->colorproductoservice = $colorproductoservice;
    }

    public function index(){
        return $this->productorepository->index();
    }

    public function store(array $dataProducto, array $imagenes, array $colores){

        $producto = $this->productorepository->store($dataProducto);

        foreach ($imagenes as $imagen){
            $ruta = $imagen->store('productos', 'public');

            $this->imagenproductoservice->store([
                'id_producto' => $producto->id,
                'url_imagen' => $ruta,
            ]);
        }

        foreach ($colores as $color){
            if (!empty($color['nombre_color'])) {
                $this->colorproductoservice->store([
                    'id_producto' => $producto->id,
                    'nombre_color' => $color['nombre_color'],
                    'codigo_hex' => $color['codigo_hex'],
                ]);
            }
        }
    }

    public function edit(int $id){
        return $this->productorepository->edit($id);
    }

    public function update(int $id, array $datosProducto, ?array $imagenes = null, ?array $colores = null){
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

        if ($colores) {
            foreach ($colores as $color) {
                if (!empty($color['nombre_color'])) {
                    $this->colorproductoservice->store([
                        'id_producto' => $id,
                        'nombre_color' => $color['nombre_color'],
                        'codigo_hex' => $color['codigo_hex'],
                    ]);
                }
            }
        }
    }   

    public function destroy(int $id){
        $producto = $this->productorepository->edit($id);

        foreach ($producto->imagen_producto as $imagen) {
            $this->imagenproductoservice->destroy($imagen->id);
        }

        foreach ($producto->color_producto as $color) {
            $this->colorproductoservice->destroy($color->id);
        }

        $this->productorepository->destroy($id);
    }

    public function variantesColor(Producto $producto){
        return $this->productorepository->buscarPorNombre($producto->nombre_producto, $producto->id);
    }

    public function obtenerImagenActual(Producto $producto, int $indice): array{
        $imagenes = $producto->imagen_producto;
        $imagenActual = $imagenes->get($indice) ?? $imagenes->first();

        return [
            'imagenActual' => $imagenActual,
            'indiceActual' => $indice,
            'tieneAnterior' => $indice > 0,
            'tieneSiguiente' => $indice < $imagenes->count() - 1,
        ];
    }

    public function indexPaginado(int $pagina = 16){
        return $this->productorepository->indexPaginado($pagina);
    }
}