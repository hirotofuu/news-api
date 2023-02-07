<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>['required', 'unique:users'],
            'email'=>['required', 'email', 'unique:users'],
            'password'=>['required', 'regex:/\A([a-zA-Z0-9]{8,})+\z/u', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'required' => '必須入力です。',
            'unique:users' => '同じメールアドレスが既に存在します',
            'email.email' => '有効なメールアドレスを入力してください。',
            'password.regex' => '8文字以上の半角英数字で入力してください',
            'confirmed'=>'確認と同じ入力をしてください',

        ];

    }
}
