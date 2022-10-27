<?php

namespace App\Filament\Pages;

use App\Settings\MobileSettings;
use Filament\Forms\Components\KeyValue;
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
//            TextInput::make("general.app_name"),
//            MarkdownEditor::make("general.description"),
//            TextInput::make("general.main_color"),
//            TextInput::make("general.second_color"),
//            TextInput::make("general.accent_color"),
//            TextInput::make("general.scaffold_color"),
//            TextInput::make("general.main_dark_color"),
//            TextInput::make("general.second_dark_color"),
//            TextInput::make("general.accent_dark_color"),
//            TextInput::make("general.scaffold_dark_color"),
//            TextInput::make("general.mobile_language"),៊
            KeyValue::make("general")
        ];
    }
}
