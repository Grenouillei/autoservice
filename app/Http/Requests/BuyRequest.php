<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyRequest extends FormRequest
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
            'name' => 'required|string|max:20|min:5',
            'lastName' => 'required|string|max:20|min:5',
            'phone' => 'required|string|max:12|min:9',
            'city' => 'required|string|max:30',
            'id_array' => 'required|string',
            'qty_array' => 'required|string',
            'sum_array' => 'required|string',
        ];
    }
}
