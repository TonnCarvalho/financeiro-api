<?php

namespace App\Http\Controllers\Api\V1\Banco;

use App\Http\Controllers\Controller;
use App\Http\Requests\BancoStoreRequest;
use App\Models\Banco;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BancoController extends Controller
{
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
    public function store(BancoStoreRequest $request): JsonResponse
    {
        $arquivo = $request->file('caminho_avatar');

        $extensao = $arquivo->extension();

        $dados = $request->safe()->except('caminho_avatar');

        $nomeImagem = Str::lower($dados['nome']).'.'.$extensao;

        $dados['caminho_avatar'] = $arquivo->storeAs(
            'imagens/bancos',
            "$nomeImagem",
            'public'
        );

        $banco = Banco::create($dados);

        return response()->json([
            'success' => true,
            'message' => 'Banco criado com sucesso.',
            'data' => $banco,
        ], 201);
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
