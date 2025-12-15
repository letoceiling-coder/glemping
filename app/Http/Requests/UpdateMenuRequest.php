<?php

namespace App\Http\Requests;

use App\Rules\StringEnglishRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'parent' => ['integer'],
            'name' => ['sometimes'],
            'active' => ['sometimes','boolean'],
            'slug' => ['sometimes',new StringEnglishRule()],
            'sort' => ['nullable','integer'],
            'image_id' => ['nullable','integer'],
            'position' => ['nullable','string'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([

            'image_id' => $this->image_id ? $this->image_id['id'] : null,
        ]);
    }
}
