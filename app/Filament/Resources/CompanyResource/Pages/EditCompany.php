<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Sorethea\Todo\Traits\AssignTrait;

class EditCompany extends EditRecord
{
    use AssignTrait;
    protected static string $resource = CompanyResource::class;

    protected function getActions(): array
    {

        return [
            $this->assignPageAction(),
            Actions\Action::make("cancel")
                ->requiresConfirmation()
                ->action(fn()=>$this->record->setState(2))
                ->visible(fn()=>$this->record->state!=2 && auth()->user()->can("companies.cancel"))
                ->color("warning"),
            Actions\Action::make("restore")
                ->requiresConfirmation()
                ->action(fn()=>$this->record->setState(0))
                ->visible(fn()=>$this->record->state==2 && auth()->user()->can("companies.restore"))
                ->color("primary"),
            Actions\DeleteAction::make(),
        ];
    }
}
