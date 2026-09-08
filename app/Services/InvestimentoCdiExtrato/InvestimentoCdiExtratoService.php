<?php

namespace App\Services\InvestimentoCdiExtrato;

use App\Models\InvestimentoCdi;
use App\Models\InvestimentoCdiExtrato;
use Illuminate\Support\Number;

class InvestimentoCdiExtratoService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function store(object $request)
    {
        $tipoOperacao = $request->input('tipo_operacao');

        $dadosRequest = $request->safe();

        $tarefa = match ($tipoOperacao) {
            'guardado' => $this->guardado($dadosRequest),
            'rendimento' => $this->rendimento($dadosRequest),
            'resgatado' => $this->resgatado($dadosRequest)
        };

        return $tarefa;
    }

    private function guardado(object $dados)
    {
        dd('guardado metodo');
    }
    //TODO colocar a data de criação enviado pelo input
    private function rendimento(object $dadosRequest): InvestimentoCdiExtrato
    {
        $maxValorBruto = InvestimentoCdiExtrato::where(
            'id_investimento',
            $dadosRequest['id_investimento']
        )
            ->max('valor_bruto');

        $maxValorLiquido = InvestimentoCdiExtrato::where(
            'id_investimento',
            $dadosRequest['id_investimento']
        )
            ->max('valor_liquido');

        $rendaBruta = $dadosRequest['valor_bruto'] - $maxValorBruto;

        $rendaLiquida = $dadosRequest['valor_liquido'] - $maxValorLiquido;

        $dadosInvestimentoCdiExtrato = [
            'id_investimento' => $dadosRequest['id_investimento'],
            'valor_bruto' => $dadosRequest['valor_bruto'],
            'valor_liquido' => $dadosRequest['valor_liquido'],
            'tipo_operacao' => $dadosRequest['tipo_operacao'],
            'renda_bruta' => $this->formatarValorParaDecimal($rendaBruta),
            'renda_liquida' => $this->formatarValorParaDecimal($rendaLiquida),
            'data_operacao' => $dadosRequest['data_operacao'],
        ];

        $investimentoCdi = InvestimentoCdi::find($dadosRequest['id_investimento']);

        $investimentoCdi->update([
            'valor_bruto' => $dadosRequest['valor_bruto'],
            'valor_liquido' => $dadosRequest['valor_liquido'],
        ]);

        return InvestimentoCdiExtrato::create($dadosInvestimentoCdiExtrato);
    }

    private function resgatado(object $dados)
    {
        dd('resgatado metodo');
    }

    private function formatarValorParaDecimal(string $valor)
    {
        return Number::format($valor, 2);
    }
}
