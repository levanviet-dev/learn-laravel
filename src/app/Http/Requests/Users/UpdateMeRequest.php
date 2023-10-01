<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\FormRequest;

class UpdateMeRequest extends FormRequest
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
            'company_name' => 'string|max:255|required',
            'department' => 'string|max:255|nullable',
            'postal_code' => 'string|max:10|required',
            'address' => 'string|nullable',
            'building_name' => 'string|max:255|nullable',
            'prefecture' => 'string|max:50|required',
            'first_name_manager' => 'string|max:50|required',
            'last_name_manager' => 'string|max:50|required',
            'email' => 'string|max:100|required|unique:users,email,NULL,id,deleted_at,NULL',
            'user_code' => 'string|max:10|required|unique:users,user_code,NULL,id,deleted_at,NULL',
            'phone_number' => 'string|max:20|required',
        ];
    }

    public function messages()
    {
        return [
            'user_code.required' => 'コードを空白のままにすることはできません。',
            'user_code.max' => 'コードは10文字以下で入力してください。',
            'user_code.unique' => 'コードは10文字以下で入力してください。',
            'company_name.required' => '会社名を空白のままにすることはできません。',
            'company_name.max' => '会社名を255文字以内で入力してください。',
            'department.max' => '部署名を255文字以内で入力してください。',
            'building_name.max' => '建物名を255文字以内で入力してください。',
            'postal_code.required' => '郵便番号を空白のままにすることはできません。',
            'prefecture.required' => '都道府県を空白のままにすることはできません。',
            'email.required' => 'メールアドレスを空白のままにすることはできません。',
            'email.max' => 'メールアドレスは100文字以下で入力してください。',
            'email.unique' => 'メールアドレスは存在しています。',
            'postal_code.max' => '郵便番号は10文字以下で入力してください。',
            'prefecture.max' => '都道府県は50文字以下で入力してください。',
            'first_name_manager.required' => 'マネージャーの姓を空白のままにすることはできません。',
            'first_name_manager.max' => '管理者の姓を50文字以内で入力してください。',
            'last_name_manager.required' => 'マネージャー名を空白のままにすることはできません。',
            'last_name_manager.max' => '管理者の名前を50文字以内で入力してください。',
            'phone_number.required' => '電話番号は空白のままにすることはできません。',
            'phone_number.max' => '電話番号は20文字を超えることはできません。',
        ];
    }
}
