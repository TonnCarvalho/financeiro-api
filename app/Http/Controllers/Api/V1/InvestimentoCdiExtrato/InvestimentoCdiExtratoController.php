<?php

namespace App\Http\Controllers\Api\V1\InvestimentoCdiExtrato;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestimentoCdiExtrato\InvestimentoCdiExtratoStoreRequest;
use App\Policies\InvestimentoCdiExtratoPolicy;
use App\Services\InvestimentoCdiExtrato\InvestimentoCdiExtratoService;
use App\Traits\HttpResponsesTrait;
use Illuminate\Http\Request;

class InvestimentoCdiExtratoController extends Controller
{
    use HttpResponsesTrait;

    public function index()
    {
        //
    }

    public function store(
    InvestimentoCdiExtratoPolicy $policy,
    InvestimentoCdiExtratoStoreRequest $request,
    InvestimentoCdiExtratoService $service,
    )
    {
        //autorizacao

        //service envia tipo
        $service->store($request);

        //return sucesso
        return $this->response(
            'ok',
            200,
            [$request->all()]
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
