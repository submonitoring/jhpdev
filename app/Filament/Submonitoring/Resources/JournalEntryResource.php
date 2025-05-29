<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Submonitoring\Clusters\MaterialDocument;
use App\Filament\Submonitoring\Resources\JournalEntryResource\Pages;
use App\Filament\Submonitoring\Resources\JournalEntryResource\RelationManagers;
use App\Models\JournalEntry;
use App\Models\MaterialMaster;
use App\Models\Plant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

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

                Tables\Columns\TextColumn::make('materialDocumentItem.materialDocument.document_number')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                Tables\Columns\TextColumn::make('materialMaster.material_number')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                Tables\Columns\TextColumn::make('materialMaster.material_desc')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                Tables\Columns\TextColumn::make('debitCredit.debit_credit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('glAccount.gl_account_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                        Tables\Actions\DeleteAction::make(),

                    ])->dropdown(false),

                ]),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                Tables\Actions\BulkAction::make('updatematerialdescplant')
                    ->label(__('Update Material Desc dan Plant Name'))
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalIconColor('info')
                    ->modalHeading('Mass Update Material Desc dan Plant Name?')
                    ->action(
                        function (Collection $records, array $data) {

                            $records->each(
                                function ($record) {

                                    $getmaterialmaster = MaterialMaster::where('id', $record->material_master_id)->first();
                                    $getplant = Plant::where('id', $record->plant_id)->first();

                                    $data['material_desc'] = $getmaterialmaster->material_desc;
                                    $data['plant_name'] = $getplant->plant_name;
                                    $record->update($data);
                                    return $record;
                                }
                            );
                        }
                    ),
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
