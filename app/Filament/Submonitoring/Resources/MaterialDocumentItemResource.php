<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Submonitoring\Resources\MaterialDocumentItemResource\Pages;
use App\Filament\Submonitoring\Resources\MaterialDocumentItemResource\RelationManagers;
use App\Models\MaterialDocumentItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialDocumentItemResource extends Resource
{
    protected static ?string $model = MaterialDocumentItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sort')
                    ->maxLength(255),
                Forms\Components\TextInput::make('material_master_id')
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
                    ->numeric(),
                Forms\Components\TextInput::make('uom_id')
                    ->numeric(),
                Forms\Components\TextInput::make('movement_type_id')
                    ->numeric(),
                Forms\Components\TextInput::make('plant_id')
                    ->numeric(),
                Forms\Components\TextInput::make('material_document_id')
                    ->numeric(),
                Forms\Components\Textarea::make('text_item')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('unique')
                    ->maxLength(26),
                Forms\Components\TextInput::make('record_title')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active'),
                Forms\Components\TextInput::make('created_by')
                    ->maxLength(255),
                Forms\Components\TextInput::make('updated_by')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort')
                    ->searchable(),
                Tables\Columns\TextColumn::make('material_master_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('uom_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('movement_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plant_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('material_document_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unique')
                    ->searchable(),
                Tables\Columns\TextColumn::make('record_title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->searchable(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMaterialDocumentItems::route('/'),
            'create' => Pages\CreateMaterialDocumentItem::route('/create'),
            'view' => Pages\ViewMaterialDocumentItem::route('/{record}'),
            'edit' => Pages\EditMaterialDocumentItem::route('/{record}/edit'),
        ];
    }
}
