<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RRhhRequest extends FormRequest
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
            'title' => ['string','required','max:100'],
            'details' => ['nullable','string','max:500']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El Titulo es requerido',
            'title.string' => 'El Titulo debe ser alfanumerico',
            'title.max' => 'El Titulo debe tener como maximo 100 caracteres',
            'details.required' => 'La Descripcion es requerida',
            'details.string' => 'La Descripcion debe ser alfanumerica',
            'details.max' => 'La Descripcion debe tener como maximo 200 caracteres'
        ];
    }
}
