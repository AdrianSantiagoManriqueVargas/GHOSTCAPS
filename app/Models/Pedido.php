<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';

    protected $fillable = [
        'estado_pedido',
        'mensaje_whatsapp',
        'costo_envio',
        'total',
        'subtotal',
        'id_cliente'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function detalle_pedido(){
        return $this->hasMany(DetallePedido::class);
    }
}
