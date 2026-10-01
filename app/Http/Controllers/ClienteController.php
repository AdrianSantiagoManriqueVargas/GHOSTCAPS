<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    private ClienteService $clienteservice;

    public function __construct(ClienteService $clienteservice){
        $this->clienteservice = $clienteservice;
    }

    public function index()
    {   
        $cliente = $this->clienteservice->index();
        return view('cliente.index', compact('cliente'));
    }

    public function create()
    {
        return view('cliente.create');
    }

    public function store(ClienteStoreRequest $request)
    {
        $this->clienteservice->store($request->validated());
        return redirect()->route('cliente.index');
    }

    public function show()
    {

    }

    public function edit(int $id)
    {
        $cliente = $this->clienteservice->edit($id);
        return view('cliente.edit', compact('cliente'));
    }

    public function update(int $id, ClienteUpdateRequest $request)
    {
        $this->clienteservice->update($id, $request->validated());
        return redirect()->route('cliente.index');
    }

    public function destroy(int $id)
    {
        $this->clienteservice->destroy($id);
        return redirect()->route('cliente.index');
    }
}
