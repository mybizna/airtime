<?php

namespace Modules\Airtime\Filament\Resources\PhoneResource\Pages;

use Modules\Airtime\Filament\Resources\PhoneResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhones extends ListRecords
{
    protected static string $resource = PhoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
