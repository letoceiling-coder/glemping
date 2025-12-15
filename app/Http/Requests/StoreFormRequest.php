<?php

namespace App\Http\Requests;

use App\Rules\StringEnglishRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
            'name' => ['required','string','max:255'],
            'method' => ['required','string','max:255','unique:forms,method',new StringEnglishRule()],
            'popup' => ['required','boolean'],
            'logo' => ['required','boolean'],
            'size' => ['nullable'],
            'bitrix' => ['nullable','boolean'],
            'statement_text' => ['nullable','string'],
            'statement' => ['nullable','boolean'],
            'save' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
            'sort' => ['nullable','integer'],
            'data' => ['nullable'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Наименование',
            'method' => 'Метод',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([

            'active' => !$this->active ? false : $this->active,
            'sort' => $this->sort ? $this->sort : 0,
        ]);
    }
}
