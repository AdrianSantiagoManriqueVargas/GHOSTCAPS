<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_producto' => 'required|string|max:100',
            'descripcion_producto' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categoria,id',
            'imagenes' => 'required|array|min:1',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png,webp|max:3048',
            'colores' => 'required|array|min:1',
            'colores.0.nombre_color' => 'required|string|max:100',
            'colores.0.codigo_hex' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'colores.1.nombre_color' => 'nullable|string|max:100',
            'colores.1.codigo_hex' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }
}