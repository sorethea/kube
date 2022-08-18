<?php

namespace Sorethea\KubeAdmin;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Sorethea\KubeAdmin\Policies\PermissionPolicy;
use Sorethea\KubeAdmin\Policies\RolePolicy;
use Sorethea\KubeAdmin\Policies\UserPolicy;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class KubeAdminAuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
    ];


    public function register()
    {
        $this->registerPolicies();
    }
}
