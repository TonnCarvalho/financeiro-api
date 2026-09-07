<?php

namespace App\Services\InvestimentoCdiExtrato;

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
        $tipo = $request->input('tipo');

        $dados = $request->safe();

        $tarefa = match ($tipo) {
            'guardado' => $this->guardado($dados),
            'rendimento' => $this->rendimento($dados),
            'resgatado' => $this->resgatado($dados)
        };
    }

    private function guardado(object $dados)
    {
        dd('guardado metodo');
    }

    private function rendimento(object $dados)
    {
        dd($dados);
        // pegar valor bruto e liquido anterior

        //fazer subtração para saber os valores de rendimento bruto e liquido

        //salvar dados
    }

    private function resgatado(object $dados)
    {
        dd('resgatado metodo');
    }
}
