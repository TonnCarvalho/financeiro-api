<?php

namespace App\Services\Bancos;

use App\Http\Requests\Bancos\BancoStoreRequest;
use App\Models\Banco;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BancoStoreService
{
    public function store(BancoStoreRequest $request)
    {
        if (!$request->hasFile('caminho_avatar')) {
            return $this->cadastraSemImagem($request);
        }

        return $this->cadastraComImagem($request);
    }

    private function cadastraSemImagem(object $request): Banco
    {
        $dados = $request->safe()->except('caminho_avatar');

        $dados['id_usuario'] = Auth::user()->id;

        $dados['nome'] = Str::ucfirst($dados['nome']);

        return Banco::create($dados);
    }

    private function cadastraComImagem(object $request): Banco
    {
        $imagem = $request->file('caminho_avatar');

        $extensao = Str::lower($imagem->extension());

        $dados = $request->safe()->except('caminho_avatar');

        $dados['id_usuario'] = Auth::user()->id;

        $dados['nome'] = Str::ucfirst($dados['nome']);

        $nomeImagem = Str::uuid();

        $path = 'imagens/bancos';

        $dados['caminho_avatar'] = $imagem->storeAs(
            $path,
            $nomeImagem . '.' . $extensao,
            'public'
        );

        return Banco::create($dados);
    }
}
