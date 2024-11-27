<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdministrativoRequest extends FormRequest
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
        $administrativo = $this->route('administrativo');

        return [
            'persona.nombre' => 'required|string|max:255|different:' . $administrativo->persona->nombre,
            'persona.direccion' => 'required|string|max:255|different:' . $administrativo->persona->direccion,
            'persona.telefono' => 'required|string|max:20|different:' . $administrativo->persona->telefono,
            'persona.correo' => 'required|email|max:255|different:' . $administrativo->persona->correo,
            'administrativo.ci' => 'required|string|max:20|different:' . $administrativo->ci,
            'administrativo.departamento' => 'required|string|max:255|different:' . $administrativo->departamento,
            'administrativo.puesto' => 'required|string|max:255|different:' . $administrativo->puesto,
            'administrativo.salario' => 'required|numeric|different:' . $administrativo->salario,
            'user.name' => 'required|string|max:255|different:' . $administrativo->user->name,
            'user.email' => 'required|email|max:255|different:' . $administrativo->user->email,
            'user.password' => 'nullable|string|min:8|different:' . $administrativo->user->password,
            'roles' => 'array',
            'roles.*' => 'exists:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ];
    }
}
