<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'sometimes|max:55',
            'phone' => ['nullable','string','max:20'],
            'password' => ['nullable','string','min:8'],

            'subscription' => ['boolean'],
            'active' => 'boolean',
            'email' => ['email','sometimes',Rule::unique('users','email')->ignore($this->id)],
            'role_id' => 'sometimes|exists:user_roles,id|integer',
        ];
    }

    protected function prepareForValidation() {

        $this->merge([

            'password' => Hash::make($this->password),
        ]);
    }

    public function messages()
    {
        return [

            'email.unique' => 'Email занят другим пользователем',


        ];
    }
}
