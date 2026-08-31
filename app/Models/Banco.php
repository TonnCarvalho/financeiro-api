<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('bancos')]

#[Fillable(['nome', 'caminho_avatar', 'ativo'])]

class Banco extends Model
{
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuairo::class, 'id_usuario');
    }
}
