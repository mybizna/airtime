<?php

namespace Modules\Airtime\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class AirtimePlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'Airtime';
    }

    public function getId(): string
    {
        return 'airtime';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
