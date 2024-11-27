<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdministrativoRequest extends FormRequest
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
            'administrativo.ci' => 'required|string|max:20|unique:administrativos,ci',
            'administrativo.departamento' => 'required|string|max:255',
            'administrativo.puesto' => 'required|string|max:255',
            'administrativo.salario' => 'required|numeric',
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|max:255|unique:users,email',
            'user.password' => 'required|string|min:8',
        ];
    }
}
