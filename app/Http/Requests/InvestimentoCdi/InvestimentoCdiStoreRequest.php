<?php

namespace App\Http\Requests\InvestimentoCdi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Override;

class InvestimentoCdiStoreRequest extends FormRequest
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
            'id_banco' => ['required', 'integer'],
            'nome' => ['required', 'string', 'max:100'],
            'valor' => ['required', 'decimal:2'],
            'valor_cdi' => ['required', 'integer'],
            'descricao' => ['nullable', 'string'],
        ];
    }

    #[Override]
    protected function prepareForValidation()
    {

        $valor = $this->formataValorParaDecimal($this->valor ?? null);

        $this->merge([
            'valor' => $valor
        ]);
    }

    private function formataValorParaDecimal(?string $valor)
    {
        if ($valor === null || Str::trim($valor) === '') {
            return $valor;
        }

        $valor = Str::of($valor)
            ->replace('.', '')
            ->replace(',', '.')
            ->toString();

        return $valor;
    }
}
