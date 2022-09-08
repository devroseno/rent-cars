<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCar extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|min:3',
            'year' => 'required|integer|min:2000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo de nome é obrigatório',
            'year.required|integer|min:2000' => 'O campo de ano é obrigatório',
            'image.nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' => 'O campo de imagem é obrigatório',
            'color.required' => 'O campo de cor é obrigatório',
        ];
    }
}
