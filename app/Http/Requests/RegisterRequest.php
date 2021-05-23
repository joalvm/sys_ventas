<?php

namespace App\Http\Requests;

use App\Models\Persons;
use App\Models\Users;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class RegisterRequest extends FormRequest
{
    protected $redirect = '/register';

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
        return array_merge(
            Arr::except((new Persons())->rules(), ['phone', 'avatar_url']),
            Arr::only((new Users())->rules(), ['username']),
            [
                'password' => ['required', 'string', 'min:6'],
                'retry_password' => ['required', 'same:password'],
                'remember_me' => ['nullable', 'boolean'],
            ]
        );
    }

    public function attributes()
    {
        return [
            'name' => 'Nombres',
            'lastname' => 'Apellidos',
            'email' => 'Correo Electónico',
            'gender' => 'Genero',
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'retry_password' => 'Confirmar Contraseña',
        ];
    }
}
