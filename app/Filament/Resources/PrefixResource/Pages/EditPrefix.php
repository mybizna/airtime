<?php

namespace Modules\Airtime\Filament\Resources\PrefixResource\Pages;

use Modules\Airtime\Filament\Resources\PrefixResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrefix extends EditRecord
{
    protected static string $resource = PrefixResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
