<?php

namespace App\Services;

use App\Repositories\CategoriaRepository;
use Illuminate\Support\Facades\Storage;

class CategoriaService
{
    private CategoriaRepository $categoriarepository;

    public function __construct(CategoriaRepository $categoriarepository)
    {
        $this->categoriarepository = $categoriarepository;
    }

    public function index()
    {
        return $this->categoriarepository->index();
    }

    public function store(array $data, $imagen = null)
    {
        if ($imagen) {
            $data['imagen_portada'] = $imagen->store('categorias', 'public');
        }

        return $this->categoriarepository->store($data);
    }

    public function edit(int $id)
    {
        return $this->categoriarepository->edit($id);
    }

    public function update(int $id, array $data, $imagen = null)
    {
        $categoria = $this->categoriarepository->edit($id);

        if ($imagen) {
            // Elimina la portada anterior si existía
            if ($categoria->imagen_portada && Storage::disk('public')->exists($categoria->imagen_portada)) {
                Storage::disk('public')->delete($categoria->imagen_portada);
            }
            $data['imagen_portada'] = $imagen->store('categorias', 'public');
        }

        $this->categoriarepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        $categoria = $this->categoriarepository->edit($id);

        if ($categoria->imagen_portada && Storage::disk('public')->exists($categoria->imagen_portada)) {
            Storage::disk('public')->delete($categoria->imagen_portada);
        }

        $this->categoriarepository->destroy($id);
    }

    public function indexPaginado(int $pagina = 10)
    {
        return $this->categoriarepository->indexPaginado($pagina);
    }
}