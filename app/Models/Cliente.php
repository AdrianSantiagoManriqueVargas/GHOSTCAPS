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

    public function getTelefonoWhatsappAttribute(): string
    {
        $numero = preg_replace('/\D/', '', $this->telefono_cliente);

        return strlen($numero) === 10 ? '57' . $numero : $numero;
    }
}
