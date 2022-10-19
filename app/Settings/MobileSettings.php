<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MobileSettings extends Settings
{
    public array $general;
    public array $theme;

    public static function group(): string
    {
        return "mobile";
    }
}
