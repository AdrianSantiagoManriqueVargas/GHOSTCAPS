<?php

namespace App\View\Composers;

use App\Services\CarritoService;
use Illuminate\View\View;

class CarritoComposer
{
    private CarritoService $carritoservice;

    public function __construct(CarritoService $carritoservice)
    {
        $this->carritoservice = $carritoservice;
    }

    public function compose(View $view): void
    {
        $view->with('totalCarrito', $this->carritoservice->totalUnidades());
    }
}