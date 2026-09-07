<?php

namespace App\Http\Controllers\Api\V1\Banco;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bancos\BancoStoreRequest;
use App\Http\Requests\Bancos\BancoUpdateRequest;
use App\Models\Banco;
use App\Services\Bancos\BancoStoreService;
use App\Services\Bancos\BancoUpdateService;
use App\Traits\ExcluirArquivoTrait;
use App\Traits\HttpResponsesTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BancoController extends Controller
{
    use HttpResponsesTrait;
    use ExcluirArquivoTrait;

    public function index()
    {
        $bancos = Banco::where('id_usuario', Auth::user()->id)
            ->get();

        if ($bancos->isEmpty()) {
            return $this->error(
                'Bancos não encontrados',
                404,
                $bancos
            );
        }

        return $this->response(
            'Bancos encontrados com sucesso',
            200,
            $bancos
        );
    }

    public function store(
        BancoStoreRequest $request,
        BancoStoreService $bancoStoreService,
    ): JsonResponse {

        $bancoCriado = $bancoStoreService->store($request);

        return $this->response(
            'Banco criado com sucesso.',
            201,
            $bancoCriado
        );
    }

    public function show(string $id): JsonResponse
    {
        $banco = Banco::find($id);

        $autorizacao = Gate::inspect('view', $banco);

        if ($autorizacao->denied()) {
            return $this->error(
                $autorizacao->message(),
                403
            );
        }

        if (!$banco) {
            return $this->error(
                "Banco não encontrado",
                404,
            );
        }

        return $this->response(
            "Banco encontrado com sucesso",
            200,
            $banco
        );
    }

    public function update(
        BancoUpdateRequest $request,
        BancoUpdateService $bancoUpdateService,
        string $id
    ) {
        $banco = Banco::find($id);

        $autorizacao = Gate::inspect('update', $banco);

        if ($autorizacao->denied()) {
            return $this->error(
                $autorizacao->message(),
                403
            );
        }
        
        $bancoAtualizado = $bancoUpdateService->update($request, $id);

        return $this->response(
            'Banco atualizado com sucesso.',
            200,
            $bancoAtualizado
        );
    }


    public function destroy(Banco $banco)
    {
        $autorizacao = Gate::inspect('delete', $banco);

        if ($autorizacao->denied()) {
            return $this->error(
                $autorizacao->message(),
                403
            );
        }

        $caminhoImagem = $banco->caminho_avatar;

        if ($caminhoImagem) {
            $this->exluirArquivo($caminhoImagem);
        }

        $bancoExcluido = $banco->delete();

        if ($bancoExcluido === 0) {
            return $this->error(
                'Banco não encontrado',
                404
            );
        }

        return $this->response(
            'Banco deletado com sucesso',
            200,
        );
    }
}
