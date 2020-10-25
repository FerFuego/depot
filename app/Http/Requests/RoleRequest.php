<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'string|required|max:20',
            'slug' => 'string|alpha_dash|required|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre es requerido',
            'name.string' => 'El Nombre debe ser alfanumerico',
            'name.max' => 'El Nombre debe tener como maximo 20 caracteres',
            'slug.required' => 'El Slug es requerido',
            'slug.string' => 'El Slug debe ser alfanumerico',
            'slug.alpha_dash' => 'El slug solo permite letras, numeros y guiones',
            'slug.max' => 'El Slug debe tener como maximo 20 caracteres'
        ];
    }
}
