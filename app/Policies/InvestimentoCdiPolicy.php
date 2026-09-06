<?php

namespace App\Policies;

use App\Models\InvestimentoCdi;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\JsonResponse;

class InvestimentoCdiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return false;
    }

    public function view(Usuario $usuario, InvestimentoCdi $investimentoCdi): Response
    {
        return $this->verificaPermissaoPorId($usuario, $investimentoCdi);
    }

    public function update(Usuario $usuario, InvestimentoCdi $investimentoCdi): Response
    {
        return $this->verificaPermissaoPorId($usuario, $investimentoCdi);
    }

    public function delete(Usuario $usuario, InvestimentoCdi $investimentoCdi): Response
    {
        return $this->verificaPermissaoPorId($usuario, $investimentoCdi);
    }

    private function verificaPermissaoPorId(Usuario $usuario, InvestimentoCdi $investimentoCdi): Response
    {
        return $usuario->id === $investimentoCdi->id_usuario
            ? Response::allow()
            : Response::deny('Não autorizario');
    }
}
