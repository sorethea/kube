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
            Action::make("Submit")->action(fn($record)=>$record->setState(1))->color("success"),
            Action::make("Cancel")->action(fn($record)=>$record->setState(2))->color("warning"),
            Actions\DeleteAction::make(),
        ];
    }
}
