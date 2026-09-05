<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('bancos')]

#[Fillable([
    'id_usuario',
    'nome',
    'caminho_avatar',
    'ativo',
])]

class Banco extends Model
{
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function cartoes(): HasMany
    {
        return $this->hasMany(Cartao::class, 'id_banco');
    }

    public function investimentoCdi(): HasMany
    {
        return $this->hasMany(InvestimentoCdi::class, 'id_banco');
    }
}
