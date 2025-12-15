<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ForgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {

        $rules = [


            'email' => 'email|required',



        ];

        return $rules;
    }

    protected function prepareForValidation(): void
    {


    }

    public function messages()
    {
        return [

            'email.required' => 'Адрес электронной почты не указан',
            'email.email' => 'В поле адрес электронной почты должен быть указан действительный адрес электронной почты',

        ];
    }
}
