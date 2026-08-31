<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('investimento_cdi')]

#[Fillable([
    'id_usuario',
    'id_banco',
    'nome',
    'valor',
    'valor_cdi',
    'descricao',
])]

class InvestimentoCdi extends Model
{
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function banco(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_banco');
    }
}
