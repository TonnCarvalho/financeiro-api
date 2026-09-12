<?php

namespace App\Services\InvestimentoCdiExtrato;

use App\Models\InvestimentoCdi;
use App\Models\InvestimentoCdiExtrato;
use Illuminate\Support\Number;
use InvalidArgumentException;

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

    private function storeGuardado(object $dadosRequest)
    {
        $investimentoCdi = InvestimentoCdi::find($dadosRequest['id_investimento']);

        $valorBruto =  $investimentoCdi->valor_bruto;
        $valorLiquido = $investimentoCdi->valor_liquido;

        $novoValorBruto = $valorBruto + $dadosRequest['valor_operacao'];
        $novoValorLiquido = $valorLiquido + $dadosRequest['valor_operacao'];

        $investimentoCdi->update([
            'valor_bruto' => $novoValorBruto,
            'valor_liquido' => $novoValorLiquido,
        ]);

        $dadosInvestimentoCdiExtrato = [
            'id_investimento' => $dadosRequest['id_investimento'],
            'valor_operacao' => $dadosRequest['valor_operacao'],
            'tipo_operacao' => $dadosRequest['tipo_operacao'],
            'data_operacao' => $dadosRequest['data_operacao']
        ];

        return InvestimentoCdiExtrato::create($dadosInvestimentoCdiExtrato);
    }

    private function storeRendimento(object $dadosRequest): InvestimentoCdiExtrato
    {
        $investimentoCdi = InvestimentoCdi::find($dadosRequest['id_investimento']);

        $valorBrutoAtual = $investimentoCdi->valor_bruto;

        $valorLiquidoAtual = $investimentoCdi->valor_liquido;

        if (
            $valorBrutoAtual > $dadosRequest['valor_bruto']
            || $valorLiquidoAtual > $dadosRequest['valor_liquido']
        ) {
            throw new InvalidArgumentException(
                'O valor bruto ou liquido informado não pode ser menor que o valor atual.'
            );
        }

        $investimentoCdi->update([
            'valor_bruto' => $dadosRequest['valor_bruto'],
            'valor_liquido' => $dadosRequest['valor_liquido'],
        ]);

        $rendaBruta = $dadosRequest['valor_bruto'] - $valorBrutoAtual;

        $rendaLiquida = $dadosRequest['valor_liquido'] - $valorLiquidoAtual;

        $dadosInvestimentoCdiExtrato = [
            'id_investimento' => $dadosRequest['id_investimento'],
            'valor_bruto' => $dadosRequest['valor_bruto'],
            'valor_liquido' => $dadosRequest['valor_liquido'],
            'tipo_operacao' => $dadosRequest['tipo_operacao'],
            'renda_bruta' => $this->formatarValorParaDecimal($rendaBruta),
            'renda_liquida' => $this->formatarValorParaDecimal($rendaLiquida),
            'data_operacao' => $dadosRequest['data_operacao'],
        ];

        return InvestimentoCdiExtrato::create($dadosInvestimentoCdiExtrato);
    }

    private function storeResgatado(object $dadosRequest)
    {
        $investimentoCdi = InvestimentoCdi::find($dadosRequest['id_investimento']);

        $valorBruto = $investimentoCdi->valor_bruto;
        $valorLiquido = $investimentoCdi->valor_liquido;

        $novoValorBruto = $valorBruto - $dadosRequest['valor_operacao'];
        $novoValorLiquido = $valorLiquido - $dadosRequest['valor_operacao'];

        
        if ($dadosRequest['valor_operacao'] > $valorLiquido) {
            throw new InvalidArgumentException(
                'O valor do resgate não pode ser maior que o valor liquido'
            );
        }

        $investimentoCdi->update([
            'valor_bruto' => $novoValorBruto,
            'valor_liquido' => $novoValorLiquido
        ]);

        $dadosInvestimentoCdiExtrato = [
            'id_investimento' => $dadosRequest['id_investimento'],
            'valor_operacao' => $dadosRequest['valor_operacao'],
            'tipo_operacao' => $dadosRequest['tipo_operacao'],
            'data_operacao' => $dadosRequest['data_operacao']
        ];

        return InvestimentoCdiExtrato::create($dadosInvestimentoCdiExtrato);
    }

    private function formatarValorParaDecimal(string $valor)
    {
        return Number::format($valor, 2);
    }
}
