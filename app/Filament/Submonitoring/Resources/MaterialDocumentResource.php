<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Submonitoring\Resources\MaterialDocumentResource\Pages;
use App\Filament\Submonitoring\Resources\MaterialDocumentResource\RelationManagers;
use App\Models\MaterialDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialDocumentResource extends Resource
{
    protected static ?string $model = MaterialDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('document_date'),
                Forms\Components\TextInput::make('transaction_type_id')
                    ->numeric(),
                Forms\Components\TextInput::make('transaction_reference_id')
                    ->numeric(),
                Forms\Components\TextInput::make('business_partner_id')
                    ->numeric(),
                Forms\Components\TextInput::make('document_type_id')
                    ->numeric(),
                Forms\Components\TextInput::make('number_range_id')
                    ->numeric(),
                Forms\Components\TextInput::make('document_number')
                    ->maxLength(255),
                Forms\Components\Textarea::make('text_header')
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
                Tables\Columns\TextColumn::make('document_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_reference_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('business_partner_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('document_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_range_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('document_number')
                    ->searchable(),
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
            'index' => Pages\ListMaterialDocuments::route('/'),
            'create' => Pages\CreateMaterialDocument::route('/create'),
            'view' => Pages\ViewMaterialDocument::route('/{record}'),
            'edit' => Pages\EditMaterialDocument::route('/{record}/edit'),
        ];
    }
}
