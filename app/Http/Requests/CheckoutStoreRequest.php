<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_cliente' => 'required|string|max:255',
            'telefono_cliente' => 'required|string|max:20',
            'correo_cliente' => 'required|email|max:255',
            'tipo_documento' => 'required|in:CC,TI,CE,PP',
            'numero_documento' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
        ];
    }
}
