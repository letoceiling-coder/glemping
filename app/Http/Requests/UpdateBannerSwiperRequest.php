<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerSwiperRequest extends FormRequest
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
            'slug' => ['nullable','string',"max:255"],
            'image_d_id' => ['sometimes','integer'],
            'image_m_id' => ['sometimes','integer'],
            'active' => ['nullable','boolean'],

        ];
    }

    protected function prepareForValidation()
    {

        if ($this->image_d_id){
            $this->merge([
                'image_d_id' =>$this->image_d_id['id'],
            ]);
        }
        if ($this->image_m_id){
            $this->merge([
                'image_m_id' =>$this->image_m_id['id'],
            ]);
        }
        $this->merge([
            'active' => $this->active ? $this->active : true,
        ]);
    }
}
