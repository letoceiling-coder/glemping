<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'images' => ['nullable','array'],
            'html' => ['nullable'],
            'date' => ['nullable'],

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([

            'date' => $this->date ? Carbon::parse($this->date) : now(),
        ]);
    }
}
