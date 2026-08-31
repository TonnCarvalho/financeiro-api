<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('grupo_despesa_usuarios')]

#[Fillable([
    'id_usuario',
    'id_grupo',
    'permissao_usuario',
])]

class GrupoDespesaUsuario extends Model
{
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function grupo_despesa(): BelongsTo
    {
        return $this->belongsTo(GrupoDespesa::class, 'id_grupo_despesa');
    }
}
