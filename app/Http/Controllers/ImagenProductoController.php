<?php

namespace App\Http\Controllers;

use App\Services\ImagenProductoService;

class ImagenProductoController extends Controller
{
    private ImagenProductoService $imagenproductoservice;

    public function __construct(ImagenProductoService $imagenproductoservice){
        $this->imagenproductoservice = $imagenproductoservice;
    }

    public function destroy(int $id){
        $this->imagenproductoservice->destroy($id);
        return redirect()->route('producto.index');
    }
}