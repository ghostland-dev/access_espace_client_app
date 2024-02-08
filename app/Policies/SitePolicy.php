<?php

namespace App\Policies;

use App\Models\Site;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the site can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list sites');
    }

    /**
     * Determine whether the site can view the model.
     */
    public function view(User $user, Site $model): bool
    {
        return $user->hasPermissionTo('view sites');
    }

    /**
     * Determine whether the site can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create sites');
    }

    /**
     * Determine whether the site can update the model.
     */
    public function update(User $user, Site $model): bool
    {
        return $user->hasPermissionTo('update sites');
    }

    /**
     * Determine whether the site can delete the model.
     */
    public function delete(User $user, Site $model): bool
    {
        return $user->hasPermissionTo('delete sites');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete sites');
    }

    /**
     * Determine whether the site can restore the model.
     */
    public function restore(User $user, Site $model): bool
    {
        return false;
    }

    /**
     * Determine whether the site can permanently delete the model.
     */
    public function forceDelete(User $user, Site $model): bool
    {
        return false;
    }
}
