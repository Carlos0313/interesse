<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewEventRequest extends FormRequest
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
            'nameEvent' => 'required|string',
            'ubication' => 'required|string',
            'date' => 'required|string|date',
            'state' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'nameEvent.required' => 'Es necesario introducir un Nombre de Evento',
            'ubication.required' => 'Es requerido una Ubicacion de evento',
            'date.required' => 'El requerido una Fecha de Evento',
            'state.required' => 'Es necesario introducir un Estado de Evento'
        ];
    }
}
