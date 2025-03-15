<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Imports\MaterialMasterPlantImporter;
use App\Filament\Submonitoring\Clusters\MaterialMaster;
use App\Filament\Submonitoring\Resources\MaterialMasterPlantResource\Pages;
use App\Filament\Submonitoring\Resources\MaterialMasterPlantResource\RelationManagers;
use App\Models\MaterialMasterPlant;
use App\Models\Plant;
use App\Models\ProcurementType;
use App\Models\StorageCondition;
use App\Models\TemperatureCondition;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ReplicateAction;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Unique;
use Schmeits\FilamentCharacterCounter\Forms\Components\Textarea;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput;
use Str;

class MaterialMasterPlantResource extends Resource
{
    protected static ?string $model = MaterialMasterPlant::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Material Master Plant';

    protected static ?string $pluralModelLabel = 'Material Master Plant';

    protected static ?string $navigationLabel = 'Material Master Plant';

    protected static ?int $navigationSort = 824000020;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = MaterialMaster::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::MaterialMasterPlantFormSchema())->columns(1);
    }

    public static function MaterialMasterPlantFormSchema(): array
    {
        return [

            Section::make('Material Master Plant')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('plant_id')
                                ->label('Plant')
                                ->required()
                                ->options(Plant::whereIsActive(1)->pluck('plant_name', 'id')),

                        ]),

                ]),

            Section::make('Stock Requirements')
                ->schema([
                    Grid::make(4)
                        ->schema([

                            TextInput::make('safety_stock')
                                ->label('Safety Stock')
                                ->numeric(),

                            TextInput::make('minimal_safety_stock')
                                ->label('Minimal Safety Stock')
                                ->numeric(),

                        ]),

                ])
                ->compact(),

            Section::make('Procurement Data')
                ->schema([
                    Grid::make(4)
                        ->schema([

                            Select::make('procurement_type_id')
                                ->label('Procurement Type')
                                // ->required()
                                ->options(ProcurementType::whereIsActive(1)->pluck('procurement_type', 'id')),

                        ]),

                ])
                ->compact(),

            Section::make('Storage Requirement Data')
                ->schema([
                    Grid::make(4)
                        ->schema([

                            Select::make('temperature_condition_id')
                                ->label('Temperature Condition')
                                // ->required()
                                ->options(TemperatureCondition::whereIsActive(1)->pluck('temperature_condition_desc', 'id')),

                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('storage_condition_id')
                                ->label('Storage Condition')
                                // ->required()
                                ->options(StorageCondition::whereIsActive(1)->pluck('storage_condition_desc', 'id')),

                        ]),

                ])
                ->compact(),

            Section::make('Batch Management Status')
                ->schema([
                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('is_external_batch')
                                ->label('Vendor Batch?')
                                ->boolean()
                                ->grouped(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('is_internal_batch')
                                ->label('Internal Batch')
                                ->boolean()
                                ->grouped(),

                        ]),

                ])
                ->compact(),

            Section::make('Status')
                ->schema([

                    Grid::make(4)
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

                TextColumn::make('materialMaster.material_number')
                    ->label('Material')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->sortable(),

                TextColumn::make('plant.plant_name')
                    ->label('Plant')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->sortable(),

                ColumnGroup::make('Stock Requirements', [

                    TextColumn::make('safety_stock')
                        ->label('Safety Stock')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('minimal_safety_stock')
                        ->label('Minimal Safety Stock')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),
                ]),

                ColumnGroup::make('Procurement Data', [

                    TextColumn::make('procurementType.procurement_type_desc')
                        ->label('Procurement Type')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Storage Requirement Data', [

                    TextColumn::make('temperatureCondition.temperature_condition_desc')
                        ->label('Temperature Condition')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('storageCondition.storage_condition_desc')
                        ->label('Storage Condition')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Batch Management Status', [

                    IconColumn::make('is_external_batch')
                        ->label('Vendor Batch?')
                        ->boolean()
                        ->sortable(),

                    IconColumn::make('is_internal_batch')
                        ->label('Internal Batch?')
                        ->boolean()
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

                        TextConstraint::make('material_master')
                            ->label('Material Master Plant')
                            ->nullable(),

                        TextConstraint::make('material_master_desc')
                            ->label('Description')
                            ->nullable(),

                        BooleanConstraint::make('deletion_flag')
                            ->label('Deletion Flag')
                            ->icon(false)
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
                    ->importer(MaterialMasterPlantImporter::class),
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

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(MaterialMasterPlantImporter::class)
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
            'index' => Pages\ListMaterialMasterPlants::route('/'),
            'create' => Pages\CreateMaterialMasterPlant::route('/create'),
            'view' => Pages\ViewMaterialMasterPlant::route('/{record}'),
            'edit' => Pages\EditMaterialMasterPlant::route('/{record}/edit'),
        ];
    }
}
