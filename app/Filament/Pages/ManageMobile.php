<?php

namespace App\Filament\Pages;

use App\Settings\MobileSettings;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class ManageMobile extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = MobileSettings::class;

    protected static function getNavigationGroup(): ?string
    {
        return trans("general.administration");
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make("general.app_name"),
            TextInput::make("general.primary_color"),
            TextInput::make("general.secondary_color"),
            MarkdownEditor::make("general.description"),
        ];
    }
}
