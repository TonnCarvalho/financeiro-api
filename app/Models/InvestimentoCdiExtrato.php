<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('investimento_cdi_extrato')]

#[Fillable([
    'id_investimento',
    'valor_bruto',
    'valor_liquido',
    'tipo',
    'renda_bruta',
    'renda_liquida',
])]

class InvestimentoCdiExtrato extends Model
{
    public function investimentoCdi():BelongsTo
    {
        return $this->belongsTo(InvestimentoCdi::class, 'id_investimento');
    }
}
