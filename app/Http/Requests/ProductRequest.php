<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|min:10',
            'body' => 'required',
            'price' => 'required',
            'photos.*' => 'image'
        ];
    }
}
