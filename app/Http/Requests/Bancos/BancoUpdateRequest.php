<?php

namespace App\Http\Requests\Bancos;

use Illuminate\Foundation\Http\FormRequest;

class BancoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id_usuario' => [
                'required',
                'integer'
            ],
            'nome' => [
                'required',
                'string',
                'max:50'
            ],
            'caminho_avatar' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg,webp',
                'max:2048'
            ],
            'ativo' => [
                'nullable',
                'boolean',
            ]
        ];
    }
}
