<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
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
            'uid' => ['nullable','string','max:10'],
            'name' => ['required','string','max:255'],
            'code' => ['required','string','max:10'],
            'sign' => ['nullable','string','max:25'],
            'nominal' => ['required','integer'],
            'course' => ['required','float'],
            'active' => ['required','boolean'],
        ];
    }
}
