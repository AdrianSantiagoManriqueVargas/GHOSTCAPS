<?php

namespace App\Services;

use App\Repositories\DetallePedidoRepository;

class DetallePedidoService
{
    private DetallePedidoRepository $detallepedidorepository;

    public function __construct(DetallePedidoRepository $detallepedidorepository)
    {
        $this->detallepedidorepository = $detallepedidorepository;
    }

    public function store(array $datosDetalle)
    {
        return $this->detallepedidorepository->store($datosDetalle);
    }
}