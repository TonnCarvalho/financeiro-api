<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Table('usuarios')]

#[Fillable(['nome', 'email', 'senha', 'caminho_avatar', 'ativo'])]

#[Hidden(['password', 'remember_token'])]

class Usuario extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
        ];
    }

    public function bancos():HasMany
    {
        return $this->hasMany(Banco::class, 'id_usuario');
    }

    public function cartoes(): HasMany
    {
        return $this->hasMany(Cartao::class, 'id_usuario');
    }

    public function despesas(): HasMany
    {
        return $this->hasMany(Despesa::class, 'id_usuario');
    }

    public function grupoDespesas(): hasMany
    {
        return $this->hasMany(GrupoDespesa::class ,'id_usuario');
    }

    public function investimentoCdi(): hasMany
    {
        return $this->hasMany(InvestimentoCdi::class ,'id_usuario');
    }

    public function itemDejesos(): hasMany
    {
        return $this->hasMany(ItemDesejo::class ,'id_usuario');
    }
    public function receitas(): hasMany
    {
        return $this->hasMany(Receita::class ,'id_usuario');
    }
}
