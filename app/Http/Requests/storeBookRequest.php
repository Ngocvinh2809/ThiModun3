<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeBookRequest extends FormRequest
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
            'name' => 'required',
            'book_id' => 'required',
            'author' => 'required',
            'category' => 'required',
            'number_page' => 'required',
            'year' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường bắt buộc',
            'book_id.required' => 'Trường bắt buộc',
            'author.required' => 'Trường bắt buộc',
            'category.required' => 'Trường bắt buộc',
            'number_page.required' => 'Trường bắt buộc',
            'year.required' => 'Trường bắt buộc',
        ];
    }
}
