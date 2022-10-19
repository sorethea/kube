<?php

namespace App\Filament\Pages;

use App\Settings\MobileSettings;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class ManageMobile extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = MobileSettings::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make("app_name")->required(),
        ];
    }
}
