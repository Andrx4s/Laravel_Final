<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateValidation extends FormRequest
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
            'name' => 'required',
            'made' => 'required',
            'count' => 'required|numeric',
            'color' => 'required',
            'price' => 'required|numeric',
            'photo' => 'required|max:2048|file|image',
            'catalog_id' => 'required',
        ];
    }
}
