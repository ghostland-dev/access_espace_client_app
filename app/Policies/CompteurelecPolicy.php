<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Compteurelec;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompteurelecPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the compteurelec can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list compteurelecs');
    }

    /**
     * Determine whether the compteurelec can view the model.
     */
    public function view(User $user, Compteurelec $model): bool
    {
        return $user->hasPermissionTo('view compteurelecs');
    }

    /**
     * Determine whether the compteurelec can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create compteurelecs');
    }

    /**
     * Determine whether the compteurelec can update the model.
     */
    public function update(User $user, Compteurelec $model): bool
    {
        return $user->hasPermissionTo('update compteurelecs');
    }

    /**
     * Determine whether the compteurelec can delete the model.
     */
    public function delete(User $user, Compteurelec $model): bool
    {
        return $user->hasPermissionTo('delete compteurelecs');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete compteurelecs');
    }

    /**
     * Determine whether the compteurelec can restore the model.
     */
    public function restore(User $user, Compteurelec $model): bool
    {
        return false;
    }

    /**
     * Determine whether the compteurelec can permanently delete the model.
     */
    public function forceDelete(User $user, Compteurelec $model): bool
    {
        return false;
    }
}
