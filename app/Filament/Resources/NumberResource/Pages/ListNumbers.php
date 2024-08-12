<?php

namespace Modules\Airtime\Filament\Resources\NumberResource\Pages;

use Modules\Airtime\Filament\Resources\NumberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNumbers extends ListRecords
{
    protected static string $resource = NumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
