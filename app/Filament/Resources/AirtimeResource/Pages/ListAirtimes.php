<?php

namespace Modules\Airtime\Filament\Resources\AirtimeResource\Pages;

use Modules\Airtime\Filament\Resources\AirtimeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAirtimes extends ListRecords
{
    protected static string $resource = AirtimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
