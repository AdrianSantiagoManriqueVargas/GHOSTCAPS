<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClienteUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $idCliente = $this->route('cliente');

        return [
            'nombre_cliente' => 'required|string|max:255',
            'telefono_cliente' => 'required|string|max:20',
            'correo_cliente' => 'required|email|max:255',
            'tipo_documento' => 'required|in:CC,TI,CE,PP',
            'numero_documento' => ['required', 'string', 'max:20', Rule::unique('cliente', 'numero_documento')->ignore($idCliente)],
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
        ];
    }
}