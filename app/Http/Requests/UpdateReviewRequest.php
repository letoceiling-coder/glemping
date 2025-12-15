<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'name' => ['nullable','string','max:255'],
//            'text' => ['required_if:video_id,null'],
//            'offer_id' => ['nullable','integer'],
//            'video_id' => ['nullable','integer'],
//            'images' => ['nullable'],
//            'avatar' => ['nullable'],
//            'type_id' => ['sometimes','integer'],
//            'date' => ['sometimes'],
//            'rating' => ['sometimes','integer'],
//            'confirmed' => ['nullable','boolean'],
//            'sort' => ['nullable','integer'],
//            'active' => ['nullable','integer'],
        ];
    }

    protected function prepareForValidation()
    {
//        $this->merge([
//            'video_id' => $this->video_id ? $this->video_id['id'] : null,
//            'active' => $this->active ?? true,
//            'sort' => $this->sort ?? 0,
//            'date' => $this->date ? Carbon::parse($this->date) : now(),
//        ]);
    }
//    public function attributes()
//    {
//        return [
//            'text'  => 'отзыв',
//            'video id'  => 'видео',
//
//        ];
//    }
//
//    public function messages()
//    {
//        return [
//            'text.required_if' => 'Поле отзыв обязательно, когда отсутствует видео.'
//        ];
//    }
}
