<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateMobileSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("mobile.general");
        $this->migrator->add("mobile.theme");
    }
}
