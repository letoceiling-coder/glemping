<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'role_id' => 'nullable|integer',
            'password' => 'required|confirmed|min:8|max:60',
            'password_confirmation' => 'required'
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'role_id' => $this->role_id ? $this->role_id : 1,
        ]);
    }
}
