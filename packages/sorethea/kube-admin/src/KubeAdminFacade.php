<?php

namespace Sorethea\KubeAdmin;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sorethea\KubeAdmin\Skeleton\SkeletonClass
 */
class KubeAdminFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kube-admin';
    }
}
