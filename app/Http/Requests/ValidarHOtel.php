<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarHOtel extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|max:255|unique:hotels,nombre,' . $this->route('id'),
        ];
    }
    public function messages()
    {
        return [
            'nombre.unique' => 'El nombre del hotel ya esxiste en la base de datos, verfique e intentelo nuevamente.'
        ];
    }
    public function attributes()
    {
        return [
            'nombre' => 'Nombre Hotel',

        ];
    }
}
