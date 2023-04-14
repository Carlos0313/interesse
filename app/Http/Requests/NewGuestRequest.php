<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewGuestRequest extends FormRequest
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
            'nombre' => 'required|string',
            'correo' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Es necesario introducir un Nombre',
            'correo.required' => 'Es requerido un Correo',
            'correo.email' => 'El formato del correo no es valido',
        ];
    }
}
