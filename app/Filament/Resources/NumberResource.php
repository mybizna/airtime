<?php

namespace Modules\Airtime\Filament\Resources;

use Modules\Airtime\Filament\Resources\NumberResource\Pages;
use Modules\Airtime\Filament\Resources\NumberResource\RelationManagers;
use Modules\Airtime\Models\Number;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NumberResource extends Resource
{
    protected static ?string $model = Number::class;

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phone')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_used')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_used')
                    ->boolean(),
                Tables\Columns\TextColumn::make('partner_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('serial_no')
                    ->numeric()
                    ->sortable(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNumbers::route('/'),
            'create' => Pages\CreateNumber::route('/create'),
            'edit' => Pages\EditNumber::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
