<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BancoStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_usuario' => ['required', 'integer', Rule::unique('bancos', 'nome')],
            'nome' => ['required', 'string', 'max:50'],
            'caminho_avatar' => ['nullable', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_usuario.required' => 'Informe o usuário',
            'nome.required' => 'Nome obrigatorio',
            'nome.max' => 'O nome deve conter no maxímo :max caracteres'
        ];
    }
}

