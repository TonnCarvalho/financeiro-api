<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('cartao_parcelas')]

#[Fillable(['id_despesa', 'id_cartao', 'numero_parcela', 'valor', 'paga'])]

class DespesaParcelas extends Model
{
    public function cartoes(): BelongsTo
    {
        return $this->belongsTo(Cartao::class, 'id_cartao');
    }

    public function despesas(): BelongsTo
    {
        return $this->belongsTo(Despesa::class, 'id_despesa');
    }
}
