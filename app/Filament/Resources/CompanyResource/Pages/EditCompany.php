<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Models\Company;
use Filament\Forms\Components\Actions\Action;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make("submit")
                ->requiresConfirmation()
                ->action(function(Model $record){
                    dd($record);
                    if(isset($record)) $record->setState(1);
                })
                ->color("success"),
            Actions\Action::make("cancel")
                ->requiresConfirmation()
                ->action(function(Model $record){
                    if(isset($record)) $record->setState(2);
                })
                ->color("warning"),
            Actions\DeleteAction::make(),
        ];
    }
}
