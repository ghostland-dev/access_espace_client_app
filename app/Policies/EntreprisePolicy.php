<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntreprisePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the entreprise can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list entreprises');
    }

    /**
     * Determine whether the entreprise can view the model.
     */
    public function view(User $user, Entreprise $model): bool
    {
        return $user->hasPermissionTo('view entreprises');
    }

    /**
     * Determine whether the entreprise can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create entreprises');
    }

    /**
     * Determine whether the entreprise can update the model.
     */
    public function update(User $user, Entreprise $model): bool
    {
        return $user->hasPermissionTo('update entreprises');
    }

    /**
     * Determine whether the entreprise can delete the model.
     */
    public function delete(User $user, Entreprise $model): bool
    {
        return $user->hasPermissionTo('delete entreprises');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete entreprises');
    }

    /**
     * Determine whether the entreprise can restore the model.
     */
    public function restore(User $user, Entreprise $model): bool
    {
        return false;
    }

    /**
     * Determine whether the entreprise can permanently delete the model.
     */
    public function forceDelete(User $user, Entreprise $model): bool
    {
        return false;
    }
}
