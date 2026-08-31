<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('cartoes')]

#[Fillable(['id_usuario',
    'id_banco',
    'numero',
    'limite',
    'bandeira',
    'cartao_principal',
    'dia_fechamento',
    'dia_vencimento',
])]

class Cartao extends Model 
{
    public function usuario():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function banco(): BelongsTo
    {
        return $this->belongsTo(Banco::class, 'id_banco');
    }
    
    public function DespesaParcelass(): HasMany
    {
        return $this->hasMany(DespesaParcelas::class, 'id_cartao');
    }

    public function despesas(): HasMany
    {
        return $this->hasMany(Despesa::class, 'id_cartao');
    }
}
