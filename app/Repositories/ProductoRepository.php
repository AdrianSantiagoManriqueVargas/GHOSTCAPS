<?php

namespace App\Repositories;
use App\Models\Producto;
use App\Models\ColorProducto;

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

        return $query->latest()->paginate($pagina)->withQueryString();
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
}