<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'uid' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'description' => ['required', 'string', 'max:3000'],
            'active' => 'boolean',
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
//            'images' => $this->images ? collect($this->images)->pluck('id') : null,
//        ]);
    }
}
