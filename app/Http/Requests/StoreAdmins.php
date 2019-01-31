<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmins extends FormRequest
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
            //
            'name' => 'required',
            'email' => 'required|unique:admins',
            'rol'=>'required',
            'password' => 'required|confirmed',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'email.required'  => 'El correo es obligatorio',
            'rol.required'  => 'El rol es requerido',
            'email.unique'  => 'correo ya existente',
            'password.required' => 'password obligatorio',
            'password.confirmed' => 'password no coincide',
        ];
    }
}
