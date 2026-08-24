<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    protected $fillable = [
        'nombre_categoria',
        'descripcion_categoria'
    ];

    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
