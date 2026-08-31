<?php

namespace App\Enum;

enum TipoDespesas: string
{
    case PIX = 'pix';
    case DEBITO = 'debito';
    case CREDITO = 'credito';

    public function label(): string
    {
        return match ($this) {
            self::PIX => 'Pix',
            self::DEBITO => 'Débito',
            self::CREDITO => 'Crédito',
        };
    }
}
