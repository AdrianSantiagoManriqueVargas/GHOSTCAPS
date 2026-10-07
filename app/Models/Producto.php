<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    use HasFactory;

    protected $table = 'producto';

    protected $fillable = [
        'nombre_producto',
        'descripcion_producto',
        'color',
        'color_secundario',
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

    public function colorClases(): string{
        return "bg-[{$this->color}]";
    }

    public function colorSecundarioClases(): string{
        return $this->color_secundario ? "bg-[{$this->color_secundario}]" : 'bg-gray-200';
    }
}