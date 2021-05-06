<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'id_user' => 'required|string|max:20',
            'id_good' => 'required|string|max:20',
            'comment' => 'required|string|min:15|max:350',
        ];
    }
    public function messages()
    {
        return [
            'comment.required'=>"Поле має бути заповнене!",
            'comment.min'=>"Поле має мати не менше 15 символів!",
            'comment.max'=>"Поле має мати не більше 350 символів!",
        ];
    }
}
