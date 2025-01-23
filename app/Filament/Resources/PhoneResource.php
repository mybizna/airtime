<?php

namespace Modules\Airtime\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Modules\Airtime\Models\Phone;
use Modules\Base\Filament\Resources\BaseResource;

class PhoneResource extends BaseResource
{
    protected static ?string $model = Phone::class;

    protected static ?string $slug = 'airtime/phone';

    protected static ?string $navigationGroup = 'Airtime';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('partner_id')
                    ->required()
                    ->numeric(),
            ]);
    }


}
