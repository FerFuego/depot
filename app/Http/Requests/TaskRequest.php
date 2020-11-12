<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'La tarea no puede estar vacia',
            'title.string' => 'La tarea debe ser solo texto',
            'title.max' => 'La tarea supera el maximo permitido, utilice el campo descripcion para el detalle',
        ];
    }
}
