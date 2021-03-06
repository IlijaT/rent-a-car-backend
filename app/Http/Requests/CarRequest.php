<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'model' => 'required|max:55',
            'consuming' => 'required|numeric',
            'registration' => 'required|unique:cars',
            'year' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'image|nullable|max:2000',
            // 'company_id' => 'required|numeric',
            
        ];
    }
}
