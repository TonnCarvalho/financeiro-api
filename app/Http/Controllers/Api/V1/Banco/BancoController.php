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

    public function index(Banco $banco)
    {
        $bancos = $banco
            ->where('id_usuario', Auth::user()->id)
            ->get();

        if ($bancos->isEmpty()) {
            return $this->error(
                'Bancos não encontrados',
                200,
                $bancos
            );
        }

        return $this->response(
            'Bancos encontrados com sucesso',
            200,
            $bancos
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
