<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cahiercharge;
use Illuminate\Auth\Access\HandlesAuthorization;

class CahierchargePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the cahiercharge can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list cahiercharges');
    }

    /**
     * Determine whether the cahiercharge can view the model.
     */
    public function view(User $user, Cahiercharge $model): bool
    {
        return $user->hasPermissionTo('view cahiercharges');
    }

    /**
     * Determine whether the cahiercharge can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create cahiercharges');
    }

    /**
     * Determine whether the cahiercharge can update the model.
     */
    public function update(User $user, Cahiercharge $model): bool
    {
        return $user->hasPermissionTo('update cahiercharges');
    }

    /**
     * Determine whether the cahiercharge can delete the model.
     */
    public function delete(User $user, Cahiercharge $model): bool
    {
        return $user->hasPermissionTo('delete cahiercharges');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete cahiercharges');
    }

    /**
     * Determine whether the cahiercharge can restore the model.
     */
    public function restore(User $user, Cahiercharge $model): bool
    {
        return false;
    }

    /**
     * Determine whether the cahiercharge can permanently delete the model.
     */
    public function forceDelete(User $user, Cahiercharge $model): bool
    {
        return false;
    }
}
