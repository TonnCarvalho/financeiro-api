<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

trait ExcluirArquivoTrait
{
    use HttpResponsesTrait;

    public function exluirArquivo(string $caminho): JsonResponse
    {
        if (!Storage::exists($caminho)) {
            return $this->response(
                'Caminho do arquivo não existe',
                200,
                $caminho,
            );
        }

        Storage::disk('public')
            ->delete($caminho);

        return $this->response(
            'Arquivo apagado com sucesso',
            200,
            $caminho,
        );
    }
}
