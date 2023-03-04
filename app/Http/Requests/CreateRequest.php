<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title'=>['required', 'max:240'],
            'content'=>['required', 'min:50', 'max:10000'],
            'category'=>['required'],
            'file'=>['max:5120'],
            'comments_open'=>['required'],
            ];
    }

    public function messages()
    {
        return [

            ];

    }
}
