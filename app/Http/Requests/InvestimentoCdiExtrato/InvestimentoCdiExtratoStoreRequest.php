<?php

namespace App\Http\Requests\InvestimentoCdiExtrato;

use App\Enum\TipoInvestimentoCdi;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'valor_bruto' => ['required', 'decimal:2'],
            'valor_liquido' => ['required', 'decimal:2'],
            'tipo' => ['required', Rule::enum(TipoInvestimentoCdi::class)]
        ];
    }

    #[Override]
    protected function prepareForValidation()
    {
        return parent::prepareForValidation();
    }

    private function formatarValorParaDecimal()
    {
    
    }
}
