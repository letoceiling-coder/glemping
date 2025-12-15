<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255'],
            'uid' => ['sometimes', 'integer'],
            'price' => ['sometimes', 'integer'],
            'description' => ['sometimes', 'string', 'max:3000'],
            'active' => 'boolean',
            'active_at' => 'nullable',
            'active_to' => 'nullable',
            'pos_x' => 'nullable',
            'pos_y' => 'nullable',
            'width' => 'nullable',
            'height' => 'nullable',
            'image_id' => 'nullable',
            'places' => 'nullable',
            'dop' => 'nullable',
            'square' => 'nullable',
            'info' => 'nullable',
            'additionally' => 'nullable',


        ];
    }

    protected function prepareForValidation()
    {
//        $this->merge([
//
//            'image_id' => $this->image_id['id'] ??  null,
//        ]);
    }
}
