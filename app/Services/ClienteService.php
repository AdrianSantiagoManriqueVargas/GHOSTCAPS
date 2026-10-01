<?php

namespace App\Services;

use App\Repositories\ClienteRepository;

class ClienteService
{
    private ClienteRepository $clienterepository;

    public function __construct(ClienteRepository $clienterepository)
    {
        $this->clienterepository = $clienterepository;
    }

    public function index()
    {
        return $this->clienterepository->index();
    }

    public function store(array $datosCliente)
    {
        return $this->clienterepository->store($datosCliente);
    }

    public function edit(int $id)
    {
        return $this->clienterepository->edit($id);
    }

    public function update(int $id, array $datosCliente)
    {
        return $this->clienterepository->update($id, $datosCliente);
    }

    public function destroy(int $id)
    {
        return $this->clienterepository->destroy($id);
    }
}