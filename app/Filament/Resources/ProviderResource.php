<?php

namespace Modules\Airtime\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Modules\Airtime\Models\Provider;
use Modules\Base\Filament\Resources\BaseResource;

class ProviderResource extends BaseResource
{
    protected static ?string $model = Provider::class;

    protected static ?string $slug = 'airtime/provider';

    protected static ?string $navigationGroup = 'Airtime';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('published')
                    ->required(),
                Forms\Components\TextInput::make('alias')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
