<?php

namespace Modules\Airtime\Filament\Resources\AirtimeResource\Pages;

use Modules\Airtime\Filament\Resources\AirtimeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAirtime extends EditRecord
{
    protected static string $resource = AirtimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
