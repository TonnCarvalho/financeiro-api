<?php

namespace App\Policies;

use App\Models\Banco;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class BancoPolicy
{

    public function view(Usuario $usuario, Banco $banco): Response
    {
       return $this->verificaPermissaoPorId($usuario, $banco);
    }


    public function update(Usuario $usuario, Banco $banco): Response
    {
        return $this->verificaPermissaoPorId($usuario, $banco);
    }


    public function delete(Usuario $usuario, Banco $banco): Response
    {
        return $this->verificaPermissaoPorId($usuario, $banco);
    }


    private function verificaPermissaoPorId(Usuario $usuario, Banco $banco): Response
    {
        return $usuario->id === $banco->id_usuario
            ? Response::allow()
            : Response::deny('Não autorizario');
    }
}
