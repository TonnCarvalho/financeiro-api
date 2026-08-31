<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('grupo_despesa')]

#[Fillable(['id_usuario', 'nome'])]

class GrupoDespesa extends Model
{
    public function usuario():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }    
    public function despesas():BelongsTo
    {
        return $this->belongsTo(Despesa::class, 'id_despesa');
    }
}
