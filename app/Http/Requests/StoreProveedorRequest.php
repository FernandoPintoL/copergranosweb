<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'persona.nombre' => 'required|string|max:255',
            'persona.direccion' => 'string|max:255',
            'persona.telefono' => 'string|max:20',
            'persona.correo' => 'required|email|max:255',
            'proveedor.nit' => 'required|string|max:20|unique:proveedores,nit',
            'proveedor.razon_social' => 'required|string|max:255|unique:proveedores,razon_social',
        ];
    }
}
