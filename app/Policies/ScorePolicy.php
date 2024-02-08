<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Score;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScorePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the score can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list scores');
    }

    /**
     * Determine whether the score can view the model.
     */
    public function view(User $user, Score $model): bool
    {
        return $user->hasPermissionTo('view scores');
    }

    /**
     * Determine whether the score can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create scores');
    }

    /**
     * Determine whether the score can update the model.
     */
    public function update(User $user, Score $model): bool
    {
        return $user->hasPermissionTo('update scores');
    }

    /**
     * Determine whether the score can delete the model.
     */
    public function delete(User $user, Score $model): bool
    {
        return $user->hasPermissionTo('delete scores');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete scores');
    }

    /**
     * Determine whether the score can restore the model.
     */
    public function restore(User $user, Score $model): bool
    {
        return false;
    }

    /**
     * Determine whether the score can permanently delete the model.
     */
    public function forceDelete(User $user, Score $model): bool
    {
        return false;
    }
}
