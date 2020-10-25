<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre es requerido',
            'name.string' => 'El Nombre debe ser alfanumerico',
            'email.required' => 'El Email es requerido',
            'email.string' => 'El Email debe ser alfanumerico',
            'email.email' => 'El Email ingresado es invalido',
            'email.unique' => 'El Email ingresado no esta disponible',
            'password.required' => 'La Contraseña es requerida',
            'password.confirmed' => 'La Contraseñas no coinciden',
            'password.string' => 'La Contraseñas debe ser alfanumerica',
            'password.min' => 'La Contraseñas debe tener al menos 8 caracteres',
        ];
    }
}
