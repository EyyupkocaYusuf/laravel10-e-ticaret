<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'content' => 'required',
            'image' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'İsim alanı boş geçilemez.',
            'name.string' => 'İsim alani sadece karakterden oluşmalıdır.',
            'name.min' => 'isim alanı en az 3 karakterden oluşmalıdır.',
            'content.required' => 'Mesaj alanı boş geçilemez.',
            'image.required' => 'Image alanı boş geçilemez.',
        ];
    }
}
