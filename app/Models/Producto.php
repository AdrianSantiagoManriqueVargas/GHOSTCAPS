<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';

    protected $fillable = [
        'nombre_producto',
        'descripcion_producto',
        'color',
        'precio',
        'stock',
        'id_categoria'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function imagen_producto(){
        return $this->hasMany(ImagenProducto::class, 'id_producto');
    }

    public function detalle_pedido(){
        return $this->hasMany(DetallePedido::class);
    }
}
