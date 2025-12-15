<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSizeRequest extends FormRequest
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

            'tags' => ['required','array'],
            'data.*.id' => ['required','integer'],
            'data.*.value' => ['required','string'],
            'active' => ['nullable','boolean'],
            'sort' => ['nullable','integer'],
            'image_id' => ['nullable','integer'],
            'category_id' => ['required','integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([

            'image_id' => $this->image_id ? $this->image_id['id'] : null,
        ]);
    }
}
