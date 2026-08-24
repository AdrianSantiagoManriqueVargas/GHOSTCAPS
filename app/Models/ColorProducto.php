<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorProducto extends Model
{
    protected $table = 'color_producto';

    protected $fillable = [
        'color',
        'id_producto'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
