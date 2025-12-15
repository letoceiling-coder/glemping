<?php

namespace App\Http\Requests;

use App\Rules\StringEnglishRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
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
            'active' => ['required','boolean'],
            'data' => ['nullable','array'],
            'description' => ['nullable','string','max:1000'],
            'head' => ['required','string','max:255'],
            'name' => ['required','string','max:60'],
            'publish' => ['required','boolean'],
            'slug' => ['required','string',new StringEnglishRule(),'max:255','unique:pages,slug'],
            'title' => ['required','string','max:255'],
        ];
    }
}
