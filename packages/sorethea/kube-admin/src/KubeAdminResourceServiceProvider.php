<?php

namespace Sorethea\KubeAdmin;

use Filament\PluginServiceProvider;
use Illuminate\Support\ServiceProvider;
use Sorethea\KubeAdmin\Filament\Pages\Profile;
use Sorethea\KubeAdmin\Filament\Resources\PermissionResource;
use Sorethea\KubeAdmin\Filament\Resources\RoleResource;
use Sorethea\KubeAdmin\Filament\Resources\UserResource;
use Spatie\LaravelPackageTools\Package;

class KubeAdminResourceServiceProvider extends PluginServiceProvider
{
    public static string $name = "kube-admin";

    protected array $resources = [
        UserResource::class,
        PermissionResource::class,
        RoleResource::class,
    ];

    protected array $pages = [
        Profile::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package->name('kube-admin');
    }


}
