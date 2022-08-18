<?php

namespace Sorethea\KubeAdmin\Filament\Resources\PermissionResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Sorethea\KubeAdmin\Filament\Resources\PermissionResource;

class ListPermissions extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
