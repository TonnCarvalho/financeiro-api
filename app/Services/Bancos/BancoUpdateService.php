<?php

namespace App\Services\Bancos;

use App\Http\Requests\Bancos\BancoUpdateRequest;
use App\Models\Banco;
use App\Traits\ExcluirArquivoTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BancoUpdateService
{
    use ExcluirArquivoTrait;

    public function update(BancoUpdateRequest $request, string $id): Banco
    {
        if (!$request->hasFile('caminho_avatar')) {
            return $this->atualizarSemImagem($request, $id);
        }

        return $this->atualizarComImagem($request, $id);
    }

    private function atualizarSemImagem(object $request, string $id): Banco
    {
        $dados = $request->safe()->except('caminho_avatar');

        $dados['nome'] = Str::ucfirst($dados['nome']);

        $dados['id_usuario'] = Auth::user()->id;

        $banco = Banco::find($id);

        $banco->update($dados);

        return $banco;
    }

    private function atualizarComImagem(object $request, string $id): Banco
    {
        $imagem = $request->file('caminho_avatar');

        $extensao = Str::lower($imagem->extension());

        $dados = $request->safe()->except('caminho_avatar');

        $dados['nome'] = Str::ucfirst($dados['nome']);

        $dados['id_usuario'] = Auth::user()->id;

        $path = 'imagens/bancos';

        $banco = Banco::find($id);

        $CaminhoImagemAtual = $banco->caminho_avatar;

        $this->exluirArquivo($CaminhoImagemAtual);

        $nomeImagem = Str::uuid();

        $dados['caminho_avatar'] = $imagem->storeAs(
            $path,
            $nomeImagem . '.' . $extensao,
            'public'
        );

        $banco->update($dados);

        return $banco;
    }
}
