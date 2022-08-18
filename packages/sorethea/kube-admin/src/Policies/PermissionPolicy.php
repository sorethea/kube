<?php

namespace Sorethea\KubeAdmin\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Permission;


class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can("permissions.viewAny");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function view(User $user, Permission $model)
    {
        return $user->can("permissions.view");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->can("permissions.create");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function update(User $user, Permission $model)
    {
        return $user->can("permissions.update");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function delete(User $user, Permission $model)
    {
        return $user->can("permissions.delete");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function restore(User $user, Permission $model)
    {
        return $user->can("permissions.restore");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Permission $model
     * @return Response|bool
     */
    public function forceDelete(User $user, Permission $model)
    {
        return $user->can("permissions.forceDelete");
    }
}
