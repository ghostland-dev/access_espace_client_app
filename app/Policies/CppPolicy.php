<?php

namespace App\Policies;

use App\Models\Cpp;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CppPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the cpp can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list cpps');
    }

    /**
     * Determine whether the cpp can view the model.
     */
    public function view(User $user, Cpp $model): bool
    {
        return $user->hasPermissionTo('view cpps');
    }

    /**
     * Determine whether the cpp can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create cpps');
    }

    /**
     * Determine whether the cpp can update the model.
     */
    public function update(User $user, Cpp $model): bool
    {
        return $user->hasPermissionTo('update cpps');
    }

    /**
     * Determine whether the cpp can delete the model.
     */
    public function delete(User $user, Cpp $model): bool
    {
        return $user->hasPermissionTo('delete cpps');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete cpps');
    }

    /**
     * Determine whether the cpp can restore the model.
     */
    public function restore(User $user, Cpp $model): bool
    {
        return false;
    }

    /**
     * Determine whether the cpp can permanently delete the model.
     */
    public function forceDelete(User $user, Cpp $model): bool
    {
        return false;
    }
}
