<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Forms\Components\Actions\Action;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make("submit")
                ->requiresConfirmation()
                ->action(fn($record)=>$record->setState(1))
                ->color("success"),
            Actions\Action::make("cancel")
                ->requiresConfirmation()
                ->action(fn($record)=>$record->setState(2))
                ->color("warning"),
            Actions\DeleteAction::make(),
        ];
    }
}
