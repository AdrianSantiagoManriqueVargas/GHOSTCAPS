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
        $buscar = $request->query('buscar');
        $pedidos = $this->pedidoservice->indexPaginado(10, $estado, $buscar);

        // Preparamos las pestañas directamente en el controlador
        $tabs = [
            ['etiqueta' => 'Todos',     'valor' => null,        'cantidad' => Pedido::count()],
            ['etiqueta' => 'Pendiente', 'valor' => 'Pendiente', 'cantidad' => Pedido::where('estado_pedido', 'Pendiente')->count()],
            ['etiqueta' => 'Entregado', 'valor' => 'Entregado', 'cantidad' => Pedido::where('estado_pedido', 'Entregado')->count()],
            ['etiqueta' => 'Cancelado', 'valor' => 'Cancelado', 'cantidad' => Pedido::where('estado_pedido', 'Cancelado')->count()],
        ];

        return view('Pedido.index', compact('pedidos', 'tabs', 'estado', 'buscar'));
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