<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MobileSettings extends Settings
{
    public string $app_name;
    public string $theme_primary;
    public string $theme_secondary;
    public string $theme_background;
    public string $theme_accent;

    public static function group(): string
    {
        return "mobile";
    }
}
