<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:15',
            'email' => 'required|string|email|max:40|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
    public function attributes()
    {
        return [

        ];
    }
    public function messages()
    {
        return [
            'name.required'=>"Поле ім'я має бути заповнене!",
            'name.max:15'=>"Ім'я має мати не більше 15 символів!",
            'email.required'=>"Поле email має бути заповнене!",
            'email.max:40'=>"Email має мати не більше 40 символів!",
            'password.required'=>"Поле пароль має бути заповнене!",
            'password.min:8'=>"Пароль має мати не менше 8 символів!"
        ];
    }
}
