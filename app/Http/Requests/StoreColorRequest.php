<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
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
            'name' => ['required','string',"max:255"],
            'hex' => ['required','string',"max:255"],
            'active' => ['boolean'],
            'image_id' => ['nullable','integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([

            'image_id' => $this->image_id ? $this->image_id['id'] : null,
        ]);
    }
}
