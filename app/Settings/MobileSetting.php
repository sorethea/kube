<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MobileSetting extends Settings
{
    private string $app_name;
    private string $theme_primary;
    private string $theme_secondary;
    private string $theme_background;
    private string $theme_accent;

    public static function group(): string
    {
        return "mobile";
    }
}
