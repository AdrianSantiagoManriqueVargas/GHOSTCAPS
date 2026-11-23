<?php

namespace App\Repositories;
use App\Models\Producto;
use App\Models\ColorProducto;
use App\Models\Categoria;

class ProductoRepository{

    public function index()
    {
        return Producto::with('categoria', 'imagen_producto')->get();
    }

    public function store(array $data)
    {
        return Producto::create($data);
    }

    public function show()
    {
        
    }

    public function edit(int $id)
    {
        $producto = Producto::findorfail($id);
        return $producto;
    }

    public function update(int $id, array $data)
    {
        $producto = Producto::findorfail($id);
        $producto->update($data);
    }

    public function destroy(int $id)
    {
        Producto::destroy($id);
    }

    public function buscarPorNombre(string $nombre, int $excluirId) // Método para buscar productos por nombre, excluyendo un ID específico
    {
        return Producto::where('nombre_producto', $nombre)->where('id', '!=', $excluirId)->get(); // El metodo where permite filtrar los productos por nombre y excluir el producto con el ID especificado (en este caso el mismo producto ya visto)
    }

    public function indexPaginado(int $pagina = 16, array $filtros = [])
    {
        $query = Producto::with(['categoria', 'imagen_producto']);

        // Búsqueda inteligente por nombre, descripción, categoría o color
        if (!empty($filtros['buscar'])) {
            $buscar = trim($filtros['buscar']);
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre_producto', 'like', "%{$buscar}%")
                  ->orWhere('descripcion_producto', 'like', "%{$buscar}%")
                  ->orWhere('id', 'like', "%{$buscar}%")
                  ->orWhereHas('categoria', function ($qc) use ($buscar) {
                      $qc->where('nombre_categoria', 'like', "%{$buscar}%");
                  })
                  ->orWhereHas('color_producto', function ($qcol) use ($buscar) {
                      $qcol->where('nombre_color', 'like', "%{$buscar}%");
                  });
            });
        }

        // Filtro por estado de stock
        if (!empty($filtros['stock'])) {
            switch ($filtros['stock']) {
                case 'agotado':
                    $query->where('stock', '<=', 0);
                    break;
                case 'bajo':
                    $query->where('stock', '>', 0)->where('stock', '<=', 2);
                    break;
                case 'disponible':
                    $query->where('stock', '>', 2);
                    break;
            }
        }

        // Filtro por categoría individual (panel de gestión)
        if (!empty($filtros['id_categoria'])) {
            $query->where('id_categoria', $filtros['id_categoria']);
        }

        if (isset($filtros['precio_min'])) {
            $query->where('precio', '>=', $filtros['precio_min']);
        }

        if (isset($filtros['precio_max'])) {
            $query->where('precio', '<=', $filtros['precio_max']);
        }

        if (!empty($filtros['colores'])) {
            $query->whereHas('color_producto', function ($q) use ($filtros) {
                $q->where(function ($q) use ($filtros) {
                    foreach ($filtros['colores'] as $color) {
                        $q->orWhereRaw('LOWER(nombre_color) = ?', [strtolower($color)]);
                    }
                });
            });
        }

        if (!empty($filtros['categorias'])) {
            $query->whereIn('id_categoria', $filtros['categorias']);
        }

        // Orden/criterio que viene de las tarjetas del inicio (si no viene, los más recientes)
        switch ($filtros['orden'] ?? null) {
            case 'mas_vendidas':
                $this->ordenarPorVentas($query);
                break;

            case 'tendencias':
                // Lo mismo, pero contando solo los pedidos de los últimos 30 días
                $this->ordenarPorVentas($query, 30);
                break;

            case 'ultimas_unidades':
                // Solo lo que todavía hay, pero queda poco; primero lo que está por agotarse
                $query->where('stock', '>', 0)
                      ->where('stock', '<=', 5)
                      ->orderBy('stock')
                      ->orderByDesc('id');
                break;

            default: // 'nuevo' o sin orden
                $query->latest();
        }

        return $query->paginate($pagina)->withQueryString();
    }

    public function categoriasDisponibles()
    {
        return Categoria::whereIn('id', Producto::select('id_categoria'))
            ->orderBy('nombre_categoria')
            ->get();
    }

    public function coloresDisponibles()
    {
        return ColorProducto::all()
            ->groupBy(fn ($color) => strtolower($color->nombre_color))
            ->map(function ($grupo) {
                return (object) [
                    'nombre_color' => $grupo->first()->nombre_color,
                    'codigo_hex'   => $grupo->countBy('codigo_hex')->sortDesc()->keys()->first(),
                ];
            })
            ->sortBy(fn ($color) => strtolower($color->nombre_color))
            ->values();
    }

    public function relacionados(Producto $producto, int $cantidad = 4)
    {
        $relacionados = Producto::with(['categoria', 'imagen_producto'])
            ->where('id_categoria', $producto->id_categoria)
            ->where('id', '!=', $producto->id)
            ->inRandomOrder()
            ->take($cantidad)
            ->get();

        if ($relacionados->count() < $cantidad) {
            $otros = Producto::with(['categoria', 'imagen_producto'])
                ->where('id', '!=', $producto->id)
                ->whereNotIn('id', $relacionados->pluck('id'))
                ->latest()
                ->take($cantidad - $relacionados->count())
                ->get();

            $relacionados = $relacionados->concat($otros);
        }

        return $relacionados;
    }

    // Descuenta stock solo si todavía alcanza. Devuelve true si desconto, false si no había suficiente
    public function descontarStock(int $id, int $cantidad): bool
    {
        return Producto::where('id', $id)
            ->where('stock', '>=', $cantidad)
            ->decrement('stock', $cantidad) > 0;
    }

    // Suma unidades de vuelta al stock
    public function devolverStock(int $id, int $cantidad): void
    {
        Producto::where('id', $id)->increment('stock', $cantidad);
    }

    // Stock actual de un producto (0 si ya no existe)
    public function stockActual(int $id): int
    {
        return (int) Producto::where('id', $id)->value('stock');
    }

    // Ordena de mayor a menor por unidades vendidas. Los pedidos cancelados no cuentan.
    // Si se pasa $dias, solo cuenta los pedidos de esos últimos días.
    private function ordenarPorVentas($query, ?int $dias = null): void
    {
        $query->withSum(['detalle_pedido as unidades_vendidas' => function ($detalle) use ($dias) {
            $detalle->whereHas('pedido', function ($pedido) use ($dias) {
                $pedido->where('estado_pedido', '!=', 'Cancelado');

                if ($dias) {
                    $pedido->where('created_at', '>=', now()->subDays($dias));
                }
            });
        }], 'cantidad')
        ->orderByDesc('unidades_vendidas')
        ->orderByDesc('id'); // desempate: si hay igual de ventas, el más nuevo primero
    }

    public function conteoPorStock(): array
    {
        return [
            'todos'       => Producto::count(),
            'disponibles' => Producto::where('stock', '>', 2)->count(),
            'bajo'        => Producto::where('stock', '>', 0)->where('stock', '<=', 2)->count(),
            'agotados'    => Producto::where('stock', '<=', 0)->count(),
        ];
    }
}