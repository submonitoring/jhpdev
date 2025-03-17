<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PlantStorageLocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlantStorageLocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_plant::storage::location');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PlantStorageLocation $plantStorageLocation): bool
    {
        return $user->can('view_plant::storage::location');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_plant::storage::location');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PlantStorageLocation $plantStorageLocation): bool
    {
        return $user->can('update_plant::storage::location');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PlantStorageLocation $plantStorageLocation): bool
    {
        return $user->can('delete_plant::storage::location');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_plant::storage::location');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, PlantStorageLocation $plantStorageLocation): bool
    {
        return $user->can('force_delete_plant::storage::location');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_plant::storage::location');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, PlantStorageLocation $plantStorageLocation): bool
    {
        return $user->can('restore_plant::storage::location');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_plant::storage::location');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, PlantStorageLocation $plantStorageLocation): bool
    {
        return $user->can('replicate_plant::storage::location');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_plant::storage::location');
    }
}
