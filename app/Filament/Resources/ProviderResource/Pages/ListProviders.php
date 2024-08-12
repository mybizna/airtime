<?php

namespace Modules\Airtime\Filament\Resources\ProviderResource\Pages;

use Modules\Airtime\Filament\Resources\ProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProviders extends ListRecords
{
    protected static string $resource = ProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
