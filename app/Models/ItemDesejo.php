<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('item_desejo')]

#[Fillable([
    'id_usuario',
    'nome',
    'imagem',
    'valor',
    'link',
])]
class ItemDesejo extends Model
{
    public function usuario(): BelongsTo
    { 
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function grupoDesejo(): HasMany
    {
        return $this->hasMany(GrupoDesejo::class, 'id_item_desejo');
    }
}
