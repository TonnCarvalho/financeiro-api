<?php

namespace App\Http\Controllers\Api\V1\Banco;

use App\Http\Controllers\Controller;
use App\Http\Requests\BancoStoreRequest;
use App\Services\Bancos\BancoStoreService;
use App\Traits\HttpResponsesTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    use HttpResponsesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
