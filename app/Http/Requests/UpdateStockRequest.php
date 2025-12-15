<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStockRequest extends FormRequest
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

            'slug' => ['nullable','string'],
            'image_id' => ['sometimes','integer'],
            'active' => ['nullable'],

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([

            'active' => $this->active ?? true,
            'image_id' => $this->image_id ? $this->image_id['id'] : null,
        ]);
    }
}
