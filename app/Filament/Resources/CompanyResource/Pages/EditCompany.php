<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Models\Company;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\BelongsToManyMultiSelect;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getActions(): array
    {
        $causer = config("todo.causer");
        $causer = new $causer;
        $causerOptions =  $causer::all()->pluck("name","id");
        return [
            Actions\Action::make("assign")
                ->form([
                    TextInput::make("title")->required(),
                    MarkdownEditor::make("comment")->required(),
                    MultiSelect::make("assigner")->options($causerOptions)
                ])
                //->requiresConfirmation()
                ->action(fn()=>$this->record->setState(1))
                ->visible(fn()=>$this->record->state==0 && auth()->user()->can("companies.submit"))
                ->color("success"),
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
