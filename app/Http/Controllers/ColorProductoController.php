<?php

namespace App\Http\Controllers;

use App\Services\ColorProductoService;

class ColorProductoController extends Controller
{
    private ColorProductoService $colorproductoservice;

    public function __construct(ColorProductoService $colorproductoservice){
        $this->colorproductoservice = $colorproductoservice;
    }

    public function destroy(int $id){
        $this->colorproductoservice->destroy($id);
        return back();
    }
}