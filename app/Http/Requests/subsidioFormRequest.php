<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class subsidioFormRequest extends FormRequest
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
        'porcentajededescuento'=>'numeric|required|max:100',
        'descripcion'=>'max:150',
        'tipodesubsidio'=>'max:45'
        ];

    }
}
