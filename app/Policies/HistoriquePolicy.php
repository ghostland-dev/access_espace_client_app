<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Historique;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoriquePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the historique can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list historiques');
    }

    /**
     * Determine whether the historique can view the model.
     */
    public function view(User $user, Historique $model): bool
    {
        return $user->hasPermissionTo('view historiques');
    }

    /**
     * Determine whether the historique can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create historiques');
    }

    /**
     * Determine whether the historique can update the model.
     */
    public function update(User $user, Historique $model): bool
    {
        return $user->hasPermissionTo('update historiques');
    }

    /**
     * Determine whether the historique can delete the model.
     */
    public function delete(User $user, Historique $model): bool
    {
        return $user->hasPermissionTo('delete historiques');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete historiques');
    }

    /**
     * Determine whether the historique can restore the model.
     */
    public function restore(User $user, Historique $model): bool
    {
        return false;
    }

    /**
     * Determine whether the historique can permanently delete the model.
     */
    public function forceDelete(User $user, Historique $model): bool
    {
        return false;
    }
}
