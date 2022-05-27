<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanciamientoRequest extends FormRequest
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
            // validacion de campos del formulario cargo
            'fuente'=>'required|string|max:50',
        ];
    }
}
