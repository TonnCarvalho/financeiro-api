<?php

namespace App\Enum;

enum PermissaoUsuarioGrupoDespesaUsuario: string
{
    case ADMIN = 'admin';
    case MEMBRO = 'membro';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrador',
            self::MEMBRO => 'Membro',
        };
    }
}
