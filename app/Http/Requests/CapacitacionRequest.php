<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapacitacionRequest extends FormRequest
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
            'nombre'=>'required|string|max:55',
            'inicio'=>'required|date',
            'fin'=>'required|date|after_or_equal:inicio',
            'modalidad'=>'required|integer',
            'descripcion'=>'string|max:250',
            'horas'=>'required|numeric|regex:/^[\d]{0,5}(\.[\d]{1,2})?$/',
            'costo'=>'required|numeric|regex:/^[\d]{0,10}(\.[\d]{1,2})?$/',
        ];
    }
}
