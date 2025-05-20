<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Submonitoring\Clusters\MaterialDocument;
use App\Filament\Submonitoring\Resources\JournalEntryResource\Pages;
use App\Filament\Submonitoring\Resources\JournalEntryResource\RelationManagers;
use App\Models\JournalEntry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JournalEntryResource extends Resource
{
    protected static ?string $model = JournalEntry::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Journal Entries';

    protected static ?string $pluralModelLabel = 'Journal Entries';

    protected static ?string $navigationLabel = 'Journal Entries';

    protected static ?int $navigationSort = 823000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = MaterialDocument::class;

    // protected static ?string $navigationGroup = 'System';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sort')
                    ->maxLength(255),
                Forms\Components\TextInput::make('material_document_item_id')
                    ->numeric(),
                Forms\Components\TextInput::make('module_aaa_id')
                    ->numeric(),
                Forms\Components\TextInput::make('debit_credit_id')
                    ->numeric(),
                Forms\Components\TextInput::make('gl_account_id')
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
                    ->numeric(),
                Forms\Components\TextInput::make('amount')
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('materialDocumentItem.material_document_id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('materialDocumentItem.materialDocument.document_number')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('material_document_item_id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('material_master_id')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('materialMaster.material_number')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                Tables\Columns\TextColumn::make('materialMaster.material_desc')
                    ->sortable(),
                Tables\Columns\TextColumn::make('module_aaa_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('debit_credit_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gl_account_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
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
            'index' => Pages\ListJournalEntries::route('/'),
            'create' => Pages\CreateJournalEntry::route('/create'),
            'view' => Pages\ViewJournalEntry::route('/{record}'),
            'edit' => Pages\EditJournalEntry::route('/{record}/edit'),
        ];
    }
}
