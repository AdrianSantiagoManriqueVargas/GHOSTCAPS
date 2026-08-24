<?php

namespace App\Services;
use App\Repositories\ProductoRepository;

class ProductoService{

    private ProductoRepository $productorepository;

    public function __construct(ProductoRepository $productorepository){
        $this->productorepository = $productorepository;
    }

    public function index(){
        return $this->productorepository->index();
    }

    public function store(array $data){
        $this->productorepository->store($data);
    }

    public function edit(int $id){
        return $this->productorepository->edit($id);
    }

    public function update(int $id, array $data){
        $this->productorepository->update($id, $data);
    }

    public function destroy(int $id){
        $this->productorepository->destroy($id);
    }
}