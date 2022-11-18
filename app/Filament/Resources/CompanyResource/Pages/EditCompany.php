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
                ->action(fn()=>$this->record->setState(1))
                ->visible(fn()=>$this->record->state!=1 && auth()->user()->can("companies.manager"))
                ->color("success"),
            Actions\Action::make("cancel")
                ->requiresConfirmation()
                ->action(fn()=>$this->record->setState(2))
                ->visible(fn()=>$this->record->state!=2 && auth()->user()->can("companies.manager"))
                ->color("warning"),
            Actions\DeleteAction::make(),
        ];
    }
}
