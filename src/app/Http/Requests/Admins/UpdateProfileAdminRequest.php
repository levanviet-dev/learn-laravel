<?php

namespace App\Http\Requests\Admins;

use App\Http\Requests\FormRequest;

class UpdateProfileAdminRequest extends FormRequest
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
            'department' => 'string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'department.max' => '所属部署を255文字以内で入力してください。'
        ];
    }
}
