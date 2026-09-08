<?php

namespace App\Http\Requests\InvestimentoCdi;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
            'valor_bruto' => ['required', 'decimal:2'],
            'valor_cdi' => ['required', 'integer'],
            'descricao' => ['nullable', 'string'],
            'data_operacao' => [
                'nullable',
                Rule::date()->todayOrBefore(),
            ],
        ];
    }

    #[Override]
    protected function prepareForValidation()
    {

        $valor_bruto = $this->formataValorParaDecimal($this->valor_bruto);
        $dataOperacao = $this->formatarData($this->data_operacao);
        $this->merge([
            'valor_bruto' => $valor_bruto,
            'data_operacao' => $dataOperacao,
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

    private function formatarData(?string $data)
    {
        $dataFormatada = Carbon::createFromFormat(
            'd/m/Y',
            $data
        )->format('Y-m-d');

        return $dataFormatada;
    }
}
