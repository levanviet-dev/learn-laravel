<?php

namespace App\Http\Requests\Admins;

use App\Http\Requests\FormRequest;

class LoginAdminRequest extends FormRequest
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
            'admin_code' => ['bail', 'required'],
            'password' => ['bail', 'required', 'regex:/^(?=.*[a-z])(?=.*\d)(?=.*(_|[^\w])).+$/']
        ];
    }

    public function messages()
    {
        return [
            'admin_code.required' => '社員番号を空白のままにすることはできません。',
            'password.required' => 'パスワードを空白のままにすることはできません。',
            'password.regex' =>
                'パスワードの形式が正しくありません。文字、数字、特殊文字を含む 8 文字以上のパスワードである必要があります。',
        ];
    }
}
