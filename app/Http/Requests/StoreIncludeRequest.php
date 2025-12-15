<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncludeRequest extends FormRequest
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
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:255'],
            'enabled' => ['required','string','max:500'],
            'additionally' => ['required','string','max:500'],
            'image_id' => ['required','integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'image_id' => $this->image_id['id'] ?? null,
        ]);
    }
}
