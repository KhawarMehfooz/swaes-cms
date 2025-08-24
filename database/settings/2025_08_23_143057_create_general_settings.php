<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.organization_name', 'YOUR ORGANIZATION NAME');
        $this->migrator->add('general.address', 'ORGANIZATION ADDRESS');
        $this->migrator->add('general.president', 'PRESIDENT');
        $this->migrator->add('general.logo', null);
        $this->migrator->add('general.currency_symbol', 'Rs');
    }
};
