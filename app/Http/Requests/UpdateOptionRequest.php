<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes','string','max:255'],
            'image_id' => ['sometimes','integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'image_id' => $this->image_id['id'] ?? null,
        ]);
    }
}
