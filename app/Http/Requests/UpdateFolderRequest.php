<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFolderRequest extends FormRequest
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
            'name' => ['sometimes',Rule::unique('folders', 'name')->ignore($this->name, 'name'),'string','max:255'],
            'slug' => ['nullable','string','max:255'],
            'sort' => ['nullable','integer'],
            'system' => ['boolean'],
        ];
    }
    protected function prepareForValidation() {
//        $this->merge([
//            'price' => $this->price ? (int)$this->price * 100 : null,
//            'price_old' => $this->price_old ? (int)$this->price_old * 100: null,
//
//        ]);
    }
    public function messages()
    {
        return [

//            'email.required' => __('main.Password is not filled in'),
//            'email.required' => __('main.Email address is not filled in'),
//            'email.email' => __('main.The email field must be a valid email address.'),

        ];
    }
}
