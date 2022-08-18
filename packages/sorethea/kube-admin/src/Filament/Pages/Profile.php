<?php

namespace Sorethea\KubeAdmin\Filament\Pages;

use Filament\Pages\Page;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.pages.profile';

    protected static bool $shouldRegisterNavigation = false;

    protected function getTitle(): string
    {
        return auth()->user()->name;
    }
}
