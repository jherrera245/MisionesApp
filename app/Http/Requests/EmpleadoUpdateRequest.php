<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoUpdateRequest extends FormRequest
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
            'nombres'=>'required|string|max:75',
            'apellidos'=>'required|string|max:75',
            'dui'=>'required|string|max:10',
            'nivel'=>'required|integer',
            'departamento'=>'required|integer',
            'cargo'=>'required|integer',
            'telefono'=>'required|string|max:9',
        ];
    }
}
