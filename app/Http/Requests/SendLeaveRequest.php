<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendLeaveRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name.value' => ['required','string','max:255'],
            'phone.value' => ['required','string','max:20'],
            'comment.value' => ['nullable','string','max:2000'],
            'check.value' => ['accepted'],
        ];
    }

    protected function prepareForValidation()
    {

        $this->merge([

            'check.value' => isBoolean(request()->all()['check']['value']) ? 'on' : 'off',
        ]);

    }

    public function messages()
    {
        return [
            'check.value' => 'Согласие на обработку персональных данных не отмечен.',
            'name.value' => 'Заполните поля Ваше имя.',
            'phone.value' => 'Номер телефона.',
        ];
    }
}
