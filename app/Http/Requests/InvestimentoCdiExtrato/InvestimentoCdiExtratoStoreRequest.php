<?php

namespace App\Http\Requests\InvestimentoCdiExtrato;

use App\Enum\TipoInvestimentoCdi;
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
            'tipo' => ['required', Rule::enum(TipoInvestimentoCdi::class)]
        ];
    }

    #[Override]
    protected function prepareForValidation()
    {
        $valorBruto = $this->formatarValorParaDecimal($this->valor_bruto);
        $valorLiquido = $this->formatarValorParaDecimal($this->valor_liquido);

        $this->merge([
            'valor_bruto' => $valorBruto,
            'valor_liquido' => $valorLiquido
        ]);
    }

    private function formatarValorParaDecimal(string $valor)
    {
        return Str::of($valor)
            ->replace('.', '')
            ->replace(',', '.')
            ->toString();
    }
}
