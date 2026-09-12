<?php

namespace App\Http\Controllers\Api\V1\InvestimentoCdiExtrato;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestimentoCdiExtrato\InvestimentoCdiExtratoStoreRequest;
use App\Policies\InvestimentoCdiExtratoPolicy;
use App\Services\InvestimentoCdiExtrato\InvestimentoCdiExtratoService;
use App\Traits\HttpResponsesTrait;
use Illuminate\Http\Request;
use InvalidArgumentException;

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
    ) {
        //autorizacao

        try {
            $tarefa = $service->store($request);

            return $this->response(
                'ok',
                200,
                $tarefa
            );
        } catch (InvalidArgumentException $exception) {
            return $this->error(
                $exception->getMessage(),
                422
            );
        }
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
