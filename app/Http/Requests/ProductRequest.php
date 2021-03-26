<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'brand' => 'required|string|max:20',
            'code' => 'required|string|max:50',
            'price' => 'required|numeric|max:15000',
            'qty' => 'required|numeric',
            'able' => 'required|boolean',
        ];
    }
}
