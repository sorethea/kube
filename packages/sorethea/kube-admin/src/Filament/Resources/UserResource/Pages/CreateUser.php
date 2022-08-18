<?php

namespace Sorethea\KubeAdmin\Filament\Resources\UserResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Sorethea\KubeAdmin\Filament\Resources\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
