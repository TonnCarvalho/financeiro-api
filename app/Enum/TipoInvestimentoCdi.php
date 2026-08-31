<?php

namespace App\Enum;

enum TipoInvestimentoCdi: string
{
    case RENDIMENTO = 'rendimento';
    case GUARDADO = 'guardado';
    case RESGATADO = 'regatado';

    public function label(): string
    {
        return match ($this) {
            self::RENDIMENTO => 'Rendimento',
            self::GUARDADO => 'Guardado',
            self::RESGATADO => 'Resgatado'
        };
    }
}
