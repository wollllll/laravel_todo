<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'list_name' => ['required', 'max:255']
        ];
    }

    public function attributes()
    {
        return [
            'list_name' => 'リスト名'
        ];
    }
}
