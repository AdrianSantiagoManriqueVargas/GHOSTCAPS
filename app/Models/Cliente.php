<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $fillable = [
        'nombre_cliente',
        'telefono_cliente',
        'correo_cliente',
        'tipo_documento',
        'numero_documento',
        'direccion',
        'ciudad'
    ];

    public function pedido(){
        return $this->hasMany(Pedido::class);
    }
}
