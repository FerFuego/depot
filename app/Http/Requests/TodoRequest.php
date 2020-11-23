<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'sucursal' => ['required'],
            'days' => ['required']
        ];
    }

    public function messages() {
        return [
            'sucursal.required' => 'Es necesario que elija una sucursal',
            'days.required' => 'Es necesario que elija los dias'
        ];
    }
}
