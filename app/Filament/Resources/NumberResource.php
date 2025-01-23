<?php

namespace Modules\Airtime\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Modules\Airtime\Models\Number;
use Modules\Base\Filament\Resources\BaseResource;

class NumberResource extends BaseResource
{
    protected static ?string $model = Number::class;

    protected static ?string $slug = 'airtime/number';

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
                Forms\Components\DateTimePicker::make('date_used'),
                Forms\Components\Toggle::make('is_used'),
                Forms\Components\TextInput::make('partner_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('serial_no')
                    ->required()
                    ->numeric(),
            ]);
    }


}
