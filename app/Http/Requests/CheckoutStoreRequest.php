<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Sanitización previa: Limpia espacios y elimina cualquier etiqueta HTML o script malicioso.
     */
    protected function prepareForValidation(): void
    {
        $ciudad = $this->filled('otra_ciudad') 
            ? $this->input('otra_ciudad') 
            : $this->input('ciudad');

        $this->merge([
            'nombre_cliente'   => strip_tags(trim((string) $this->input('nombre_cliente'))),
            'telefono_cliente' => preg_replace('/[^0-9]/', '', (string) $this->input('telefono_cliente')), // Deja solo dígitos
            'correo_cliente'   => strtolower(trim((string) $this->input('correo_cliente'))),
            'numero_documento' => strip_tags(trim((string) $this->input('numero_documento'))),
            'direccion'        => strip_tags(trim((string) $this->input('direccion'))),
            'ciudad'           => strip_tags(trim((string) $ciudad)),
        ]);
    }

    public function rules(): array
    {
        return [
            // Solo letras, tildes, puntos y espacios (mínimo 3 letras, máximo 100)
            'nombre_cliente'   => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s\.\'-]+$/u'],
            
            // Solo dígitos: mínimo 7 (fijos) y máximo 10-15 dígitos (celulares en Colombia: 10 dígitos)
            'telefono_cliente' => ['required', 'string', 'min:7', 'max:15'],
            
            // Correo con validación estricta de formato
            'correo_cliente'   => ['required', 'email:rfc,dns', 'max:150'],
            
            // Documento oficial
            'tipo_documento'   => ['required', 'in:CC,TI,CE,PP'],
            'numero_documento' => ['required', 'string', 'min:5', 'max:20', 'regex:/^[0-9A-Za-z\-]+$/'],
            
            // Dirección limpia
            'direccion'        => ['required', 'string', 'min:5', 'max:150'],
            'ciudad'           => ['required', 'string', 'min:3', 'max:80'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_cliente.regex'   => 'El nombre solo debe contener letras y espacios válidos.',
            'telefono_cliente.min'   => 'Ingresa un número de teléfono o celular válido.',
            'correo_cliente.email'   => 'El correo electrónico ingresado no tiene un formato válido.',
            'numero_documento.regex' => 'El número de documento no debe contener caracteres especiales.',
        ];
    }
}