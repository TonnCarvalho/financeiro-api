<?php

namespace App\Services\InvestimentoCdiExtrato;

use App\Models\InvestimentoCdi;
use App\Models\InvestimentoCdiExtrato;
use Illuminate\Support\Number;

class InvestimentoCdiExtratoService
{

    public function store(object $request)
    {
        $tipoOperacao = $request->input('tipo_operacao');

        $dadosRequest = $request->safe();

        $tarefa = match ($tipoOperacao) {
            'guardado' => $this->storeGuardado($dadosRequest),
            'rendimento' => $this->storeRendimento($dadosRequest),
            'resgatado' => $this->storeResgatado($dadosRequest)
        };

        return $tarefa;
    }

    private function storeGuardado(object $dados)
    {
        dd('guardado metodo');
    }

    private function storeRendimento(object $dadosRequest): InvestimentoCdiExtrato
    {
        $maxValorBruto = InvestimentoCdi::query()
            ->where('id', $dadosRequest['id_investimento'])
            ->value('valor_bruto');

        $maxValorLiquido = InvestimentoCdi::query()
            ->where('id', $dadosRequest['id_investimento'])
            ->value('valor_liquido');

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

    private function storeResgatado(object $dados)
    {
        dd('resgatado metodo');
    }

    private function formatarValorParaDecimal(string $valor)
    {
        return Number::format($valor, 2);
    }
}
