<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageToFolderRequest extends FormRequest
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
            'id' => ['required','integer'],
            'folder' => ['required','integer','not_in:0'],
        ];
    }
    protected function prepareForValidation() {
//        $this->merge([
//            'price' => $this->price ? (int)$this->price * 100 : null,
//
//        ]);
    }
    public function messages()
    {
        return [
//
            'folder.not_in' => "Не выбрана папка для экспорта",
//            'name.required' => "Заполните наименование папки",


        ];
    }
}
