<?php

namespace App\Services;
use App\Repositories\CategoriaRepository;

class CategoriaService{

    private CategoriaRepository $categoriarepository;

    public function __construct(CategoriaRepository $categoriarepository){
        $this->categoriarepository = $categoriarepository;
    }

    public function index(){
        return $this->categoriarepository->index();
    }

    public function store(array $data){
        $this->categoriarepository->store($data);
    }

    public function edit(int $id){
        return $this->categoriarepository->edit($id);
    }

    public function update(int $id, array $data){
        $this->categoriarepository->update($id, $data);
    }

    public function destroy(int $id){
        $this->categoriarepository->destroy($id);
    }

}