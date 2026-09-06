<?php

namespace App\Http\Controllers\Api\V1\InvestimentoCdi;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestimentoCdi\InvestimentoCdiStoreRequest;
use App\Models\InvestimentoCdi;
use App\Traits\HttpResponsesTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        //
    }

    public function update(Request $request, string $id)
    {
        //
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
