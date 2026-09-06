<?php

namespace App\Policies;

use App\Models\InvestimentoCdi;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class InvestimentoCdiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, InvestimentoCdi $investimentoCdi): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, InvestimentoCdi $investimentoCdi): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, InvestimentoCdi $investimentoCdi): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, InvestimentoCdi $investimentoCdi): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, InvestimentoCdi $investimentoCdi): bool
    {
        return false;
    }
}
