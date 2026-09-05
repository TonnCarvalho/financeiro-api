<?php

namespace App\Services\Bancos;

use App\Http\Requests\BancoStoreRequest;
use App\Models\Banco;
use Illuminate\Support\Str;

class BancoStoreService
{
    public function store(BancoStoreRequest $request)
    {
        $arquivo = $request->file('caminho_avatar');

        $extensao = Str::lower($arquivo->extension());

        $dados = $request->except('caminho_avatar');

        $nomeImagem = Str::slug($dados['nome']);

        $path = 'imagens/bancos';

        $dados['caminho_avatar'] = $arquivo->storeAs(
            $path,
            $nomeImagem . $extensao,
            'public'
        );

        return Banco::create($dados);
    }
}
