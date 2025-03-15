<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Imports\MaterialMasterImporter;
use App\Filament\Submonitoring\Clusters\MaterialMaster as ClustersMaterialMaster;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\Pages;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers\AllMaterialMasterSalesRelationManager;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers\BomHeadersRelationManager;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers\MaterialMasterPlantsRelationManager;
use App\Models\Division;
use App\Models\IndustrySector;
use App\Models\MaterialGroup;
use App\Models\MaterialMaster;
use App\Models\MaterialType;
use App\Models\NumberRange;
use App\Models\Uom;
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

class MaterialMasterResource extends Resource
{
    protected static ?string $model = MaterialMaster::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Material Master';

    protected static ?string $pluralModelLabel = 'Material Master';

    protected static ?string $navigationLabel = 'Material Master';

    protected static ?int $navigationSort = 824000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ClustersMaterialMaster::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::MaterialMasterFormSchema())->columns(1);
    }

    public static function MaterialMasterFormSchema(): array
    {
        return [

            Section::make('Material Master')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('material_type_id')
                                ->label('Material Type')
                                ->required()
                                ->live()
                                ->options(MaterialType::whereIsActive(1)->pluck('material_type_desc', 'id'))
                                ->disabledOn('edit')
                                ->afterStateUpdated(function (Set $set, $state) {

                                    $getnriid = MaterialType::whereId($state)->first();

                                    if ($state === null) {
                                        return;
                                    } else {

                                        $getisexternal = NumberRange::whereId($getnriid->number_range_id)->first();

                                        $set('is_external', $getisexternal->is_external);
                                    }
                                }),

                            Hidden::make('is_external')
                                ->live(),

                            Select::make('industry_sector_id')
                                ->label('Industry Sector')
                                ->default(1)
                                ->options(IndustrySector::whereIsActive(1)->pluck('industry_sector_desc', 'id')),

                        ]),

                ]),

            Section::make('Material Number')
                ->hidden(fn(Get $get) => $get('material_type_id') === null)
                ->schema([
                    Grid::make(4)
                        ->schema([

                            TextInput::make('material_number')
                                ->label('Material Number')
                                ->unique(MaterialMaster::class, modifyRuleUsing: function (Unique $rule) {

                                    return $rule->where('is_external', true);
                                }, ignoreRecord: true)
                                ->disabled(fn(Get $get) => $get('is_external') === 0),

                            TextInput::make('old_material_number')
                                ->label('Old Material Number'),

                        ]),

                    TextInput::make('material_desc')
                        ->label('Material Description')
                        ->required(),

                ]),

            Section::make('General Data')
                ->hidden(fn(Get $get) => $get('material_type_id') === null)
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('material_group_id')
                                ->label('Material Group')
                                ->required()
                                ->options(MaterialGroup::whereIsActive(1)->pluck('material_group_desc', 'id')),

                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('division_id')
                                ->label('Division')
                                ->options(Division::whereIsActive(1)->pluck('division_name', 'id')),

                        ]),
                ]),

            Section::make('Batch Status')
                ->hidden(fn(Get $get) => $get('material_type_id') === null)
                ->schema([

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('is_batch')
                                ->label('Batch handled?')
                                ->boolean()
                                ->grouped(),

                        ]),

                ]),

            Section::make('BoM Status')
                ->hidden(fn(Get $get) => $get('material_type_id') === null)
                ->schema([

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('is_bom_header')
                                ->label('Material as BoM Header?')
                                ->boolean()
                                ->grouped(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('is_bom_item')
                                ->label('Material as BoM Item?')
                                ->boolean()
                                ->grouped(),

                        ]),

                ]),

            Section::make('Price')
                ->hidden(fn(Get $get) => $get('material_type_id') === null)
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('price')
                                ->label('Harga Barang')
                                ->numeric(),

                        ]),


                ]),

            Section::make('Dimensions')
                ->hidden(fn(Get $get) => $get('material_type_id') === null)
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('base_uom_id')
                                ->label('Base UoM')
                                ->required()
                                ->options(Uom::whereIsActive(1)->pluck('uom', 'id')),

                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('weight_unit_id')
                                ->label('Weight Unit')
                                ->options(Uom::whereIsActive(1)->pluck('uom', 'id')),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('gross_weight')
                                ->label('Gross Weight')
                                ->numeric(),

                            TextInput::make('net_weight')
                                ->label('Net Weight')
                                ->numeric(),

                        ]),


                ]),

            Section::make('Status')
                ->hidden(fn(Get $get) => $get('material_type_id') === null)
                ->schema([

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('deletion_flag')
                                ->label('Deletion Flag')
                                ->boolean()
                                ->grouped()
                                ->default(false),

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

                ColumnGroup::make('Material Master Data', [

                    TextColumn::make('material_number')
                        ->label('Material Number')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('old_material_number')
                        ->label('Old Material Number')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('material_desc')
                        ->label('Material Description')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Material Data', [

                    TextColumn::make('materialType.material_type')
                        ->label('Material Type')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('materialType.material_type_desc')
                        ->label('Material Type Desc')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('industrySector.industry_sector')
                        ->label('Industry Sector')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('materialGroup.material_group')
                        ->label('Material Group')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('division.division_name')
                        ->label('Division')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Dimension', [

                    TextColumn::make('uom.uom')
                        ->label('Base UoM')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('uom.uom')
                        ->label('Weight Unit')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('gross_weight')
                        ->label('Gross Weight')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('net_weight')
                        ->label('Net Weight')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Deletion Flag', [

                    IconColumn::make('deletion_flag')
                        ->label('Deletion Flag')
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
                            ->label('Material Master')
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
                    ->importer(MaterialMasterImporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                        Tables\Actions\DeleteAction::make(),
                    ])->dropdown(false),

                    ReplicateAction::make()
                        ->form([

                            TextInput::make('material_number')
                                ->unique(MaterialMaster::class, modifyRuleUsing: function (Unique $rule) {

                                    return $rule->where('is_external', true);
                                })
                                ->hidden(fn(Get $get) => $get('is_external') === 0),
                        ])
                        ->beforeReplicaSaved(function (Model $replica): void {

                            $getmaterialtypeMaterialType = $replica->material_type_id;

                            $getnriid = MaterialType::whereId($getmaterialtypeMaterialType)->first();

                            $getisexternal = NumberRange::whereId($getnriid->number_range_id)->first();

                            if ($getisexternal->is_external === 1) {
                                return;
                            } else {

                                $getcurrentnr = NumberRange::whereId($getnriid->number_range_id)->first();

                                $replica->material_number = $getcurrentnr->current_number + 1;

                                $updatecurrentnumber = NumberRange::whereId($getnriid->number_range_id)->first();
                                $updatecurrentnumber->current_number = $replica->material_number;
                                $updatecurrentnumber->save();
                            }
                        })
                        ->successRedirectUrl(fn(Model $replica): string => route('filament.submonitoring.material-master-data.resources.MaterialMasters.edit', $replica)),


                ]),

                RelationManagerAction::make('matplant')
                    ->label('Plant')
                    ->icon('heroicon-m-arrow-right-end-on-rectangle')
                    ->button()
                    ->outlined()
                    ->modalWidth('full')
                    ->modalSubmitActionLabel('Save')
                    ->relationManager(MaterialMasterPlantsRelationManager::make()),

                RelationManagerAction::make('matsales')
                    ->label('Sales')
                    ->icon('heroicon-m-arrow-right-end-on-rectangle')
                    ->button()
                    ->outlined()
                    ->modalWidth('full')
                    ->modalSubmitActionLabel('Save')
                    ->relationManager(AllMaterialMasterSalesRelationManager::make()),

                RelationManagerAction::make('bomheader')
                    ->label('BoM')
                    ->icon('heroicon-m-queue-list')
                    ->button()
                    ->outlined()
                    ->modalWidth('full')
                    ->modalSubmitActionLabel('Save')
                    ->hidden(fn($record) => $record->is_bom_header == null)
                    ->relationManager(BomHeadersRelationManager::make()),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(MaterialMasterImporter::class)
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
            'index' => Pages\ListMaterialMasters::route('/'),
            'create' => Pages\CreateMaterialMaster::route('/create'),
            'view' => Pages\ViewMaterialMaster::route('/{record}'),
            'edit' => Pages\EditMaterialMaster::route('/{record}/edit'),
        ];
    }
}
