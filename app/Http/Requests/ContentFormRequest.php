<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentFormRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'surname' => 'required|string|max:25',
            'email' => 'required|email|email|max:50',
            'subject' => 'required|string|max:90',
            'message' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'İsim alanı boş geçilemez.',
            'name.string' => 'İsim alani sadece karakterden oluşmalıdır.',
            'name.max' => 'isim alanı en fazla 25 karakterden oluşmalıdır.',
            'surname.required' => 'Soyisim alanı boş geçilemez.',
            'surname.string' => 'Soyisim alani sadece karakterden oluşmalıdır.',
            'surname.max' => 'Soyisim alanı en fazla 25 karakterden oluşmalıdır.',
            'email.required' => 'Mail alanı boş geçilemez.',
            'email.email' => 'Geçersiz bir mail adresi girdiniz.',
            'email.max' => 'Email alanı en fazla 50 karakterden oluşmalıdır.',
            'subject.required' => 'Konu alanı boş geçilemez.',
            'subject.max' => 'Konu alanı en fazla 90 karakterden oluşmalıdır.',
            'message.required' => 'Mesaj alanı boş geçilemez.',

        ];
    }
}
