<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ModuleBaa;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModuleBaaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_module::baa');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ModuleBaa $moduleBaa): bool
    {
        return $user->can('view_module::baa');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_module::baa');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ModuleBaa $moduleBaa): bool
    {
        return $user->can('update_module::baa');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ModuleBaa $moduleBaa): bool
    {
        return $user->can('delete_module::baa');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_module::baa');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, ModuleBaa $moduleBaa): bool
    {
        return $user->can('force_delete_module::baa');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_module::baa');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, ModuleBaa $moduleBaa): bool
    {
        return $user->can('restore_module::baa');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_module::baa');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, ModuleBaa $moduleBaa): bool
    {
        return $user->can('replicate_module::baa');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_module::baa');
    }
}
