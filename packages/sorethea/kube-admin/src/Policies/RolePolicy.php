<?php

namespace Sorethea\KubeAdmin\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Role;


class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can("roles.viewAny");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Role $model
     * @return bool
     */
    public function view(User $user, Role $model): bool
    {
        return $user->can("roles.view");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can("roles.create");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Role $model
     * @return bool
     */
    public function update(User $user, Role $model): bool
    {
        return $user->can("roles.update");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Role $model
     * @return bool
     */
    public function delete(User $user, Role $model): bool
    {
        return $user->can("roles.delete");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Role $model
     * @return bool
     */
    public function restore(User $user, Role $model): bool
    {
        return $user->can("roles.restore");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Role $model
     * @return bool
     */
    public function forceDelete(User $user, Role $model): bool
    {
        return $user->can("roles.forceDelete");
    }
}
