<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Brand;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BrandResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BrandResource\RelationManagers;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\SelectFilter;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $modelLabel = 'Производитель';
    protected static ?string $pluralModelLabel = 'Производители';
    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('slug')
                        ->required(fn (?Brand $record) => $record instanceof Brand)
                        ->disabled(fn (?Brand $record) => !($record instanceof Brand))
                        ->maxLength(255),
                    Forms\Components\Toggle::make('active')
                        ->columnSpan('full')
                        ->default(true)
                        ->required(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Наименование')
                    ->sortable()
                    ->searchable()
                    ->description(fn (?Brand $record) => $record->slug),
                Tables\Columns\IconColumn::make('active')
                    ->label('Статус')
                    ->action(function (Brand $record) {
                        $record->update(['active' => !$record->active]);
                    })
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('active')
                    ->label('Статус')
                    ->options([
                        1 => 'Активные',
                        0 => 'Неактивные'
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])->defaultSort('name');
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
