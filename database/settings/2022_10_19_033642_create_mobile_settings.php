<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateMobileSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("mobile.app_name");
        $this->migrator->add("mobile.theme_primary");
        $this->migrator->add("mobile.theme_secondary");
        $this->migrator->add("mobile.theme_accent");
        $this->migrator->add("mobile.theme_background");
    }
}
