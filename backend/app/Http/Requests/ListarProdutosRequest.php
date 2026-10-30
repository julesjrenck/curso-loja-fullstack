<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListarProdutosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'page' => [
                'bail',
                'sometimes',
                'required',
                'integer',
                'min:1',
                'max:1000000',
                'regex:/\A[1-9][0-9]*\z/',
            ],
        ];
    }
}
