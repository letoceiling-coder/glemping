<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {

        $rules = [


            'email' => 'email|required',
            'password' => 'required'


        ];

        return $rules;
    }

    protected function prepareForValidation(): void
    {


    }

    public function messages()
    {
        return [

            'password.required' => 'Пароль не введен',
            'email.required' => 'Адрес электронной почты не указан',
            'email.email' => 'В поле адрес электронной почты должен быть указан действительный адрес электронной почты',

        ];
    }
}
