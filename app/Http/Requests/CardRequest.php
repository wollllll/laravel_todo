<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'card_title' => 'required|max:255',
            'card_memo' => 'required|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'card_title' => 'カード名',
            'card_memo' => 'メモ',
        ];
    }
}
