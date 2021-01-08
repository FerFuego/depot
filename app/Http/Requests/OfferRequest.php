<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'details' => ['string','required','max:200'],
            //'file' => ['image','mimes:jpeg,png,PNG,bmp,jpg,gif,svg','max:10240']
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
            'details.max' => 'La Descripcion debe tener como maximo 200 caracteres',
            'file.image' => 'El archivo debe ser una imagen',
            'file.mimes' => 'La imagen debe tener uno de los siguientes formatos jpeg, png, bmp, jpg, gif, svg',
            'file.max' => 'La imagen debe tener como maximo 10mb',
        ];
    }
}
