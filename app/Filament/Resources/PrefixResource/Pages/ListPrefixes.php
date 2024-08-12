<?php

namespace Modules\Airtime\Filament\Resources\PrefixResource\Pages;

use Modules\Airtime\Filament\Resources\PrefixResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrefixes extends ListRecords
{
    protected static string $resource = PrefixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
