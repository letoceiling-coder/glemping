<?php

namespace App\Http\Requests;

use App\Rules\FormCheckFields;
use App\Rules\FormCheckFieldsLabel;
use App\Rules\StringEnglishRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFormRequest extends FormRequest
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
            'name' => ['sometimes','string','max:255'],
            'method' => ['sometimes','string','max:255','unique:forms,method,' . $this->id,new StringEnglishRule()],
            'active' => ['nullable','boolean'],
            'size' => ['nullable','string'],
            'bitrix' => ['nullable','boolean'],
            'statement_text' => ['nullable','string'],
            'statement' => ['nullable','boolean'],
            'save' => ['nullable','boolean'],
            'logo' => ['sometimes','boolean'],
            'popup' => ['sometimes','boolean'],
            'sort' => ['nullable','integer'],
            'data' => ['nullable'],
            'data.*.cols.*' => ['sometimes',new FormCheckFields()],
            'data.*.cols.*.data.label' => ['sometimes',new FormCheckFieldsLabel()],


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
