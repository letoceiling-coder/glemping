<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeoPageRequest extends FormRequest
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
            'description' => ['sometimes','string','max:1000'],
            'slug' => ['sometimes','string','max:255',\Illuminate\Validation\Rule::unique('seo_pages')->ignore($this->id)],
            'title' => ['sometimes','string','max:255'],
        ];
    }
}
