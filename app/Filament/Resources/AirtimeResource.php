<?php

namespace Modules\Airtime\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Modules\Airtime\Models\Airtime;
use Modules\Base\Filament\Resources\BaseResource;

class AirtimeResource extends BaseResource
{
    protected static ?string $model = Airtime::class;

    protected static ?string $slug = 'airtime/airtime';

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
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('paid'),
                Forms\Components\TextInput::make('payment_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('partner_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('purchase_date'),
                Forms\Components\TextInput::make('prefix_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('provider_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('country_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('completed'),
                Forms\Components\Toggle::make('successful'),
                Forms\Components\Toggle::make('status'),
            ]);
    }

}
