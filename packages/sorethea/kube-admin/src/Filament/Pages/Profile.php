<?php

namespace Sorethea\KubeAdmin\Filament\Pages;

use Filament\Pages\Page;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'kube-admin::filament.pages.profile';

    protected static bool $shouldRegisterNavigation = true;

    protected function getTitle(): string
    {
        return auth()->user()->name;
    }
}
