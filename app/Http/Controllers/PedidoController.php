<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    private PedidoService $pedidoservice;

    public function __construct(PedidoService $pedidoservice)
    {
        $this->pedidoservice = $pedidoservice;
    }

    public function index(Request $request)
    {
        $estado = $request->query('estado');
        $pedidos = $this->pedidoservice->indexPaginado(10, $estado);

        $conteo = [
            'todos'      => Pedido::count(),
            'Pendiente'  => Pedido::where('estado_pedido', 'Pendiente')->count(),
            'Entregado'  => Pedido::where('estado_pedido', 'Entregado')->count(),
            'Cancelado'  => Pedido::where('estado_pedido', 'Cancelado')->count(),
        ];

        return view('Pedido.index', compact('pedidos', 'conteo', 'estado'));
    }

    public function show(int $id)
    {
        $pedido = $this->pedidoservice->buscarConDetalle($id);
        return view('Pedido.show', compact('pedido'));
    }

    public function updateEstado(Request $request, int $id)
    {
        $request->validate([
            'estado_pedido' => 'required|in:Pendiente,Entregado,Cancelado',
        ]);

        $this->pedidoservice->actualizarEstado($id, $request->input('estado_pedido'));

        return redirect()->back()->with('mensaje', 'El estado del pedido se actualizó correctamente.');
    }
}