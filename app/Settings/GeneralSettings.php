<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $organization_name;

    public string $address;

    public string $president;

    public ?string $logo;

    public string $currency_symbol = 'Rs';

    public static function group(): string
    {
        return 'general';
    }
}
