<?php

namespace App\Http\Requests;

use App\Rules\StringEnglishRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageRequest extends FormRequest
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
            'active' => ['sometimes','boolean'],
            'data' => ['nullable','array'],
            'description' => ['nullable','string','max:1000'],
            'head' => ['sometimes','string','max:255'],
            'name' => ['sometimes','string','max:60'],
            'publish' => ['sometimes','boolean'],
            'slug' => ['sometimes','string',new StringEnglishRule(),'max:255',\Illuminate\Validation\Rule::unique('pages')->ignore($this->id)],
            'title' => ['sometimes','string','max:255'],
        ];
    }
}
