<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogoIndexRequest extends FormRequest
{
    // El catálogo es público: cualquiera puede verlo
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'precio_min'   => 'nullable|numeric|min:0',
            'precio_max'   => 'nullable|numeric|min:0',
            'colores'      => 'nullable|array',
            'colores.*'    => 'string|max:50',
            'categorias'   => 'nullable|array',
            'categorias.*' => 'integer',
            'orden'        => 'nullable|in:mas_vendidas,nuevo,ultimas_unidades,tendencias',
        ];
    }
}