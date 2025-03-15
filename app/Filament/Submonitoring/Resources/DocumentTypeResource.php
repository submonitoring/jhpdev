<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\DocumentTypeExporter;
use App\Filament\Imports\DocumentTypeImporter;
use App\Filament\Submonitoring\Resources\DocumentTypeResource\Pages;
use App\Filament\Submonitoring\Resources\DocumentTypeResource\RelationManagers;
use App\Filament\Submonitoring\Resources\DocumentTypeResource\RelationManagers\ItemCategoriesRelationManager;
use App\Models\DocumentType;
use App\Models\ModuleCaa;
use App\Models\NumberRange;
use App\Models\StatusGroup;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput;

class DocumentTypeResource extends Resource
{
    protected static ?string $model = DocumentType::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Document Type';

    protected static ?string $pluralModelLabel = 'Document Type';

    protected static ?string $navigationLabel = 'Document Type';

    protected static ?int $navigationSort = 940000100;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = SystemGeneral::class;

    protected static ?string $navigationGroup = 'System General';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::DocumentTypeFormSchema());
    }

    public static function DocumentTypeFormSchema(): array
    {
        return [

            Section::make('Document Type')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('document_type')
                                ->label('Document Type')
                                ->required()
                                ->unique(DocumentType::class, ignoreRecord: true),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('document_type_desc')
                                ->label('Description')
                                ->required(),

                        ]),

                ])
                ->compact(),

            Section::make('Reversal Document Type')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('document_type_id')
                                ->label('Reversal Document Type')
                                ->native(false)
                                ->options(DocumentType::whereIsActive(1)->pluck('document_type_desc', 'id')),

                        ]),

                ])
                ->compact(),

            Section::make('Number Range Interval')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('number_range_id')
                                ->label('Number Range Interval')
                                ->required()
                                ->native(false)
                                ->options(NumberRange::whereIsActive(1)->pluck('number_range_interval', 'id')),

                        ]),

                ])
                ->compact(),

            Section::make('Module Caa')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('module_caa_id')
                                ->label('Module Caa')
                                ->native(false)
                                ->options(ModuleCaa::whereIsActive(1)->pluck('module_caa_name', 'id')),

                        ]),

                ])
                ->compact(),

            Section::make('Status Group')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('status_group_id')
                                ->label('Status Group')
                                ->native(false)
                                ->options(StatusGroup::whereIsActive(1)->pluck('status_group_name', 'id')),

                        ]),

                ])
                ->compact(),

            Section::make('Status')
                ->schema([

                    Grid::make(2)
                        ->schema([

                            ToggleButtons::make('is_active')
                                ->label('Active?')
                                ->boolean()
                                ->grouped()
                                ->default(true),

                        ]),
                ])->collapsible()
                ->compact(),

        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Document Type', [

                    TextColumn::make('document_type')
                        ->label('Document Type')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('document_type_desc')
                        ->label('Description')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),
                ]),

                ColumnGroup::make('Reversal Document Type', [

                    TextColumn::make('DocumentType.document_type')
                        ->label('Reversal Doc Ty')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('DocumentType.document_type_desc')
                        ->label('Reversal Doc Ty')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Number Range', [

                    TextColumn::make('numberRange.number_range_interval')
                        ->label('Number Range Interval')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('numberRange.number_range_name')
                        ->label('Number Range Name')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Module Caa', [

                    TextColumn::make('moduleCaa.module_caa')
                        ->label('Module Caa')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('moduleCaa.module_caa_name')
                        ->label('Module Caa Name')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Status Group', [

                    TextColumn::make('statusGroup.status_group')
                        ->label('Status Group')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('statusGroup.status_group_name')
                        ->label('Status Group Name')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),


                ColumnGroup::make('Status', [

                    IconColumn::make('is_active')
                        ->label('Status')
                        ->boolean()
                        ->sortable(),

                ]),

                ColumnGroup::make('Logs', [

                    TextColumn::make('created_by')
                        ->label('Created by')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('updated_by')
                        ->label('Updated by')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                ]),
            ])
            ->recordUrl(null)
            ->searchOnBlur()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        TextConstraint::make('document_type')
                            ->label('Document Type')
                            ->nullable(),

                        TextConstraint::make('document_type_desc')
                            ->label('Description')
                            ->nullable(),

                        BooleanConstraint::make('is_active')
                            ->label('Status')
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('created_by')
                            ->label('Created by')
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('updated_by')
                            ->label('Updated by')
                            ->icon(false)
                            ->nullable(),

                        DateConstraint::make('created_at')
                            ->icon(false)
                            ->nullable(),

                        DateConstraint::make('updated_at')
                            ->icon(false)
                            ->nullable(),

                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),

                ImportAction::make()
                    ->label('Import')
                    ->importer(DocumentTypeImporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),

                RelationManagerAction::make('assignitemcategory')
                    ->label('Assign Item Categories')
                    ->icon('heroicon-m-arrow-right-end-on-rectangle')
                    ->button()
                    ->outlined()
                    ->modalWidth('full')
                    ->modalSubmitActionLabel('Save')
                    ->relationManager(ItemCategoriesRelationManager::make()),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(DocumentTypeExporter::class)
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
            'index' => Pages\ListDocumentTypes::route('/'),
            'create' => Pages\CreateDocumentType::route('/create'),
            'view' => Pages\ViewDocumentType::route('/{record}'),
            'edit' => Pages\EditDocumentType::route('/{record}/edit'),
        ];
    }
}
