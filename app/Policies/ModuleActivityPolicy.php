<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ModuleActivity;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModuleActivityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_module::activity');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ModuleActivity $moduleActivity): bool
    {
        return $user->can('view_module::activity');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_module::activity');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ModuleActivity $moduleActivity): bool
    {
        return $user->can('update_module::activity');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ModuleActivity $moduleActivity): bool
    {
        return $user->can('delete_module::activity');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_module::activity');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, ModuleActivity $moduleActivity): bool
    {
        return $user->can('force_delete_module::activity');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_module::activity');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, ModuleActivity $moduleActivity): bool
    {
        return $user->can('restore_module::activity');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_module::activity');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, ModuleActivity $moduleActivity): bool
    {
        return $user->can('replicate_module::activity');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_module::activity');
    }
}
