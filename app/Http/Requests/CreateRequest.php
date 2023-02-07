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
            'title'=>['required', 'max:100'],
            'content'=>['required', 'min:50', 'max:10000'],
            'category'=>['required'],
            'file_image'=>['file','max:1'],
            'comments_open'=>['required'],
            ];
    }

    public function messages()
    {
        return [
            'required' => '必須入力です。',
            'min:50' => '50字以上で入力してください',
            'min:100' => '100字以内で入力してください',
            'max:10000' => '10000字以内で入力してください',
            'file' => 'upload file',
            'max:1' => '10MB',
            ];

    }
}
