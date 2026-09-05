<?php

namespace App\Http\Controllers\Api\V1\Banco;

use App\Http\Controllers\Controller;
use App\Http\Requests\BancoStoreRequest;
use App\Models\Banco;
use App\Services\Bancos\BancoStoreService;
use App\Traits\HttpResponsesTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BancoController extends Controller
{
    use HttpResponsesTrait;

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

        $banco = $bancoStoreService->store($request);

        return $this->response(
            'Banco criado com sucesso.',
            201,
            $banco
        );
    }

    public function show(string $id): JsonResponse
    {
        $banco = Banco::where('id', $id)
            ->get();

        if ($banco->isEmpty()) {
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
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bancoExcluido = Banco::destroy($id);

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
