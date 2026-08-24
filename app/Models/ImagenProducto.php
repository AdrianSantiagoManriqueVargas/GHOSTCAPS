<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    protected $table = 'imagen_producto';

    protected $fillable = [
        'url_imagen',
        'id_producto'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
