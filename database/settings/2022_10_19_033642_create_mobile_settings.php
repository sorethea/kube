<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateMobileSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("mobile.general.app_name","Kub Application");
        $this->migrator->add("mobile.theme.primary", "#ed1c24");
    }
}
