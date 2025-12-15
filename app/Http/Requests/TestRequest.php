<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            'html' => ['string','min:255'],
            'daterange' => ['string','min:255'],
            'date' => ['string','min:255'],
            'phone' => ['string','min:255'],
            'input' => ['string','min:255'],
            'inputs' => ['required','string','min:255'],
            'textarea' => ['required','string','min:255'],
            'select' => ['required','string','min:255'],
            'select_one' => ['required','string','min:255'],
            'check' => ['required','string','min:255'],
            'select_two' => ['required','string','min:255'],
            'inputicon.text' => ['required','string','min:255'],
        ];
    }
}
