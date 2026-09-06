<?php

namespace App\Http\Controllers\Api\V1\InvestimentoCdi;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestimentoCdi\InvestimentoCdiStoreRequest;
use App\Models\InvestimentoCdi;
use App\Traits\HttpResponsesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestimentoCdiController extends Controller
{
    use HttpResponsesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
