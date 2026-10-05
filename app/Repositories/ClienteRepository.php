<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository
{
    public function index()
    {
        return Cliente::all();
    }

    public function store(array $datosCliente)
    {
        return Cliente::create($datosCliente);
    }

    public function edit(int $id)
    {
        return Cliente::findOrFail($id);
    }

    public function update(int $id, array $datosCliente)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($datosCliente);
        return $cliente;
    }

    public function destroy(int $id)
    {
        $cliente = Cliente::findOrFail($id);
        return $cliente->delete();
    }

    public function buscarPorDocumento(string $numeroDocumento)
    {
        return Cliente::where('numero_documento', $numeroDocumento)->first();
    }
}