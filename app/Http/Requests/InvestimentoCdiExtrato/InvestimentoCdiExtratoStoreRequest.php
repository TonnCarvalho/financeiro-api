<?php

namespace App\Http\Requests\InvestimentoCdiExtrato;

use App\Enum\TipoOperacaoInvestimentoCdi;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Override;

class InvestimentoCdiExtratoStoreRequest extends FormRequest
{

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
            'id_investimento' => [
                'required',
                'integer'
            ],
            'valor_bruto' => [
                'required_if:tipo_operacao,rendimento',
                'decimal:2'
            ],
            'valor_liquido' => [
                'required_if:tipo_operacao,rendimento',
                'decimal:2'
            ],
            'valor_operacao' => [
                'required_if:tipo_operacao,guardado',
                'decimal:2'
            ],
            'tipo_operacao' => [
                'required',
                Rule::enum(TipoOperacaoInvestimentoCdi::class)
            ],
            'data_operacao' => [
                'required',
                Rule::date()->todayOrBefore()
            ]
        ];
    }

    #[Override]
    protected function prepareForValidation()
    {
        $valorBruto = $this->formatarValorParaDecimal($this->valor_bruto ?? null);
        $valorLiquido = $this->formatarValorParaDecimal($this->valor_liquido ?? null);
        $valorOperacao = $this->formatarValorParaDecimal($this->valor_operacao ?? null);
        $dataOperacao = $this->formatarData($this->data_operacao);

        $this->merge([
            'valor_bruto' => $valorBruto,
            'valor_liquido' => $valorLiquido,
            'valor_operacao' => $valorOperacao,
            'data_operacao' => $dataOperacao,
        ]);
    }

    private function formatarValorParaDecimal(?string $valor)
    {
        if ($valor === null) return "";

        return Str::of($valor)
            ->replace('.', '')
            ->replace(',', '.')
            ->toString();
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
