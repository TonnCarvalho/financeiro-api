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
            'id_investimento' => ['required', 'integer'],
            'valor_bruto' => ['required', 'decimal:2'],
            'valor_liquido' => ['required', 'decimal:2'],
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
        $valorBruto = $this->formatarValorParaDecimal($this->valor_bruto);
        $valorLiquido = $this->formatarValorParaDecimal($this->valor_liquido);
        $dataOperacao = $this->formatarData($this->data_operacao);

        $this->merge([
            'valor_bruto' => $valorBruto,
            'valor_liquido' => $valorLiquido,
            'data_operacao' => $dataOperacao,
        ]);
    }

    private function formatarValorParaDecimal(string $valor)
    {
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
