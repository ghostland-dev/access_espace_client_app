<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Compteurgaz;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompteurgazPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the compteurgaz can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list compteurgazs');
    }

    /**
     * Determine whether the compteurgaz can view the model.
     */
    public function view(User $user, Compteurgaz $model): bool
    {
        return $user->hasPermissionTo('view compteurgazs');
    }

    /**
     * Determine whether the compteurgaz can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create compteurgazs');
    }

    /**
     * Determine whether the compteurgaz can update the model.
     */
    public function update(User $user, Compteurgaz $model): bool
    {
        return $user->hasPermissionTo('update compteurgazs');
    }

    /**
     * Determine whether the compteurgaz can delete the model.
     */
    public function delete(User $user, Compteurgaz $model): bool
    {
        return $user->hasPermissionTo('delete compteurgazs');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete compteurgazs');
    }

    /**
     * Determine whether the compteurgaz can restore the model.
     */
    public function restore(User $user, Compteurgaz $model): bool
    {
        return false;
    }

    /**
     * Determine whether the compteurgaz can permanently delete the model.
     */
    public function forceDelete(User $user, Compteurgaz $model): bool
    {
        return false;
    }
}
