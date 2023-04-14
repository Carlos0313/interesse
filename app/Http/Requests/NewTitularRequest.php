<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewTitularRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
