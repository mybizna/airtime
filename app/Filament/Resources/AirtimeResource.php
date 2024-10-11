<?php

namespace Modules\Airtime\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Airtime\Models\Airtime;
use Modules\Base\Filament\Resources\BaseResource;
use Modules\Base\Filament\Resources\Pages;

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phone')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('paid')
                    ->boolean(),
                Tables\Columns\TextColumn::make('payment_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('partner_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purchase_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('prefix_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('provider_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('country_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('completed')
                    ->boolean(),
                Tables\Columns\IconColumn::make('successful')
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {

        Pages\ListBase::setResource(static::class);

        return [
            'index' => Pages\ListBase::route('/'),
            'create' => Pages\CreateBase::route('/create'),
            'edit' => Pages\EditBase::route('/{record}/edit'),
        ];
    }

}
