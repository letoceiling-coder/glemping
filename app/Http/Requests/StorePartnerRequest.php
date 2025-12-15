<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
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
            'name' => ['nullable','string','max:255'],
            'slug' => ['nullable','string','max:255'],
            'image_id' => ['required','integer'],
            'active' => ['nullable','boolean'],
            'sort' => ['nullable','integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'active' => $this->active ?? true,
            'sort' => $this->sort ?? 0,
            'image_id' => $this->image_id ? $this->image_id['id'] : null,
        ]);
    }
}
