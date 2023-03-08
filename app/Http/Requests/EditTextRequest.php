<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTextRequest extends FormRequest
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
            'source'=>['max:1000'],
            'category'=>['required'],
            ];
    }

    public function messages()
    {
        return [

            ];

    }
}
