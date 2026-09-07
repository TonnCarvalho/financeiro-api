<?php

namespace App\Http\Controllers\Api\V1\InvestimentoCdi;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestimentoCdi\InvestimentoCdiStoreRequest;
use App\Http\Requests\InvestimentoCdi\InvestimentoCdiUpdateRequest;
use App\Models\InvestimentoCdi;
use App\Traits\HttpResponsesTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InvestimentoCdiController extends Controller
{
    use HttpResponsesTrait;

    public function index()
    {
        $dados = InvestimentoCdi::query()
            ->select([
                'id',
                'id_usuario',
                'id_banco',
                'nome',
                'valor',
                'valor_cdi',
                'created_at',
            ])
            ->where('id_usuario', Auth::user()->id)
            ->with([
                'banco' => function ($q) {
                    $q->select([
                        'id',
                        'nome',
                        'caminho_avatar'
                    ]);
                }
            ])
            ->get();

        if ($dados->isEmpty()) {
            return $this->error(
                'Investimentos não encontrados',
                404
            );
        }

        return $this->response(
            'Investimentos encontrados com sucesso',
            200,
            $dados
        );
    }

    public function store(InvestimentoCdiStoreRequest $request)
    {
        $dados = $request->validated();

        $dados['id_usuario'] = Auth::user()->id;

        $investimentoCriado = InvestimentoCdi::create($dados);

        return $this->response(
            'Investimento criado com sucesso.',
            201,
            $investimentoCriado
        );
    }

    public function show(string $id)
    {
        $investimentoCdi = InvestimentoCdi::find($id);

        $autorizacao = Gate::inspect('view', $investimentoCdi);

        if($autorizacao->denied()) {
            return $this->error(
                $autorizacao->message(),
                404
            );
        }

        if(!$investimentoCdi) {
            return $this->error(
            'Investimento não encontrado',
            404
            );
        }

        return $this->response(
            'investimento encontrado com sucesso',
            200,
            $investimentoCdi
        );
    }

    public function update(InvestimentoCdiUpdateRequest $request, int $id): JsonResponse
    {
        $investimentoCdi = InvestimentoCdi::find($id);

        $autorizacao = Gate::inspect('update', $investimentoCdi);

        if ($autorizacao->denied()) {
            return $this->error(
                $autorizacao->message(),
                404
            );
        }

        $dados = $request->validated();

        $investimentoCdi->update($dados);

        $investimentoCdiAtualizado = InvestimentoCdi::find($id);

        return $this->response(
            "Investimento atualizado com sucesso",
            200,
            [
                'InvestimentoAtualizado' => $investimentoCdiAtualizado
            ]
        );
    }

    public function destroy(InvestimentoCdi $investimentoCdi): JsonResponse
    {
        $autorizacao = Gate::inspect('delete', $investimentoCdi);

        if ($autorizacao->denied()) {
            return $this->error(
                $autorizacao->message(),
                403
            );
        }

        $nomeInvestimento = $investimentoCdi->nome;

        $investimentoCdi->delete();

        return $this->response(
            "Investimento {$nomeInvestimento} apagado com sucesso",
            200,
            [
                'nomeInvestimento' => $nomeInvestimento
            ],
        );
    }
}
