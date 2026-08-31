<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('grupo_desejo')]

#[Fillable(['id_lista_desejo', 'nome'])]

class GrupoDesejo extends Model
{
    public function itemDesejo(): BelongsTo
    {
        return $this->belongsTo(ItemDesejo::class, 'id_item_desejo');
    }
}
