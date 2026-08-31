<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Table('despesas')]

#[Fillable(['id_usuario',
    'id_cartao',
    'id_grupo_despesa',
    'nome',
    'valor',
    'tipo_despesa',
    'data',
    'paga',
    'descricao',
])]

class Despesa extends Model
{
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function cartao(): BelongsTo
    {
        return $this->belongsTo(Cartao::class, 'id_cartao');
    }

    public function grupoDespesa(): HasOne
    {
        return $this->hasOne(GrupoDespesa::class, 'id_grupo_despesa');
    }

    public function despesaParcelas(): HasMany
    {
        return $this->hasMany(DespesaParcelas::class, 'id_despesa');
    }
}
