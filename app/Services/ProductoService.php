<?php

namespace App\Services;

use App\Models\Producto;
use App\Repositories\ProductoRepository;
use Illuminate\Validation\ValidationException;

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

    public function indexPaginado(int $pagina = 16, array $filtros = []){
        return $this->productorepository->indexPaginado($pagina, $filtros);
    }

    public function coloresDisponibles(){
        return $this->productorepository->coloresDisponibles();
    }

    public function categoriasDisponibles(){
        return $this->productorepository->categoriasDisponibles();
    }

    public function productosRelacionados(Producto $producto)
    {
        return $this->productorepository->relacionados($producto);
    }

    // Stock actual de un producto
    public function stockActual(int $idProducto): int
    {
        return $this->productorepository->stockActual($idProducto);
    }

    // Descuenta el stock de un producto. Devuelve false si no alcanzaba
    public function descontarStock(int $idProducto, int $cantidad): bool
    {
        return $this->productorepository->descontarStock($idProducto, $cantidad);
    }

    // Devuelve unidades al stock (por ejemplo, al cancelar un pedido)
    public function devolverStock(int $idProducto, int $cantidad): void
    {
        $this->productorepository->devolverStock($idProducto, $cantidad);
    }

    // Descuenta el stock de todo el carrito
    // Si algún producto no alcanza, lanza un error, la transacción de quien lo llame
    // deshace los descuentos que ya se habían hecho
    public function descontarStockCarrito(array $items): void
    {
        $sinStock = [];

        foreach ($items as $item) {
            $producto = $item['producto'];

            if (!$this->productorepository->descontarStock($producto->id, $item['cantidad'])) {
                $stockActual = $this->productorepository->stockActual($producto->id);
                $sinStock[] = "\"{$producto->nombre_producto}\" (disponible: {$stockActual}, solicitado: {$item['cantidad']})";
            }
        }

        if (!empty($sinStock)) {
            throw ValidationException::withMessages([
                'stock' => 'No se pudo completar la compra. Estos productos no tienen stock suficiente: ' . implode(', ', $sinStock) . '. Ajusta tu carrito e intenta de nuevo.'
            ]);
        }
    }
}