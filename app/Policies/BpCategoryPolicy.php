<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BpCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class BpCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_bp::category');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BpCategory $bpCategory): bool
    {
        return $user->can('view_bp::category');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_bp::category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BpCategory $bpCategory): bool
    {
        return $user->can('update_bp::category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BpCategory $bpCategory): bool
    {
        return $user->can('delete_bp::category');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_bp::category');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, BpCategory $bpCategory): bool
    {
        return $user->can('force_delete_bp::category');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_bp::category');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, BpCategory $bpCategory): bool
    {
        return $user->can('restore_bp::category');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_bp::category');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, BpCategory $bpCategory): bool
    {
        return $user->can('replicate_bp::category');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_bp::category');
    }
}
