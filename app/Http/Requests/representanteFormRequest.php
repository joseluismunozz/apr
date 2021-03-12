<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class representanteFormRequest extends FormRequest
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
        'idvivienda'=>'Numeric|required',
        'rut'=>array('required',
            'regex:/^\d{1,2}\.\d{3}\.\d{3}[-][0-9kK]{1}$/'),
        'telefono'=>'Numeric|required',
        'nombre'=>'required',
        'email'=>'email:rfc,dns'
        ];
    }
}
