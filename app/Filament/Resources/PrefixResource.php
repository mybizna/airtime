<?php

namespace Modules\Airtime\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Modules\Airtime\Models\Prefix;
use Modules\Base\Filament\Resources\BaseResource;

class PrefixResource extends BaseResource
{
    protected static ?string $model = Prefix::class;

    protected static ?string $slug = 'airtime/prefix';

    protected static ?string $navigationGroup = 'Airtime';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('prefix')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('published')
                    ->required(),
                Forms\Components\TextInput::make('provider_id')
                    ->required()
                    ->numeric(),
            ]);
    }


}
