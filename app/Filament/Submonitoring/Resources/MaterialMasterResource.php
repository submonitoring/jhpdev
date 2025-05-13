<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Imports\MaterialMasterImporter;
use App\Filament\Submonitoring\Clusters\MaterialMaster as ClustersMaterialMaster;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\Pages;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\Pages\EditMaterialMaster;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\Pages\ViewMaterialMaster;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers\AllMaterialMasterSalesRelationManager;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers\BomHeadersRelationManager;
use App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers\MaterialMasterPlantsRelationManager;
use App\Models\AccountAssignmentGroup;
use App\Models\DistributionChannel;
use App\Models\Division;
use App\Models\IndustrySector;
use App\Models\MaterialGroup;
use App\Models\MaterialMaster;
use App\Models\MaterialMasterPlant;
use App\Models\MaterialMasterSales;
use App\Models\MaterialType;
use App\Models\NumberRange;
use App\Models\Plant;
use App\Models\ProcurementType;
use App\Models\SalesOrganization;
use App\Models\StorageCondition;
use App\Models\TaxClassification;
use App\Models\TemperatureCondition;
use App\Models\Uom;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
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
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
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

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::MaterialMasterFormSchema())->columns(1);
    }

    public static function MaterialMasterFormSchema(): array
    {
        return [

            Section::make('Material Master')
                ->icon('heroicon-o-cube')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('material_type_id')
                                ->label('Material Type')
                                ->required()
                                ->live()
                                ->native(false)
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
                                ->native(false)
                                ->options(IndustrySector::whereIsActive(1)->pluck('industry_sector_desc', 'id')),

                        ]),

                ])->compact(),

            Tabs::make()
                ->hidden(fn(Get $get) => $get('material_type_id') === null)
                ->schema([

                    Tab::make('Material Master')
                        // ->icon('heroicon-o-user-group')
                        // ->disabled(fn(Get $get) => $get('material_type_id') === null)
                        ->schema([

                            Section::make('Material Number')
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

                                ])
                                ->compact(),

                            Section::make('General Data')
                                ->schema([

                                    Grid::make(4)
                                        ->schema([

                                            Select::make('material_group_id')
                                                ->label('Material Group')
                                                ->required()
                                                ->native(false)
                                                ->options(MaterialGroup::whereIsActive(1)->pluck('material_group_desc', 'id')),

                                        ]),
                                ])
                                ->compact(),

                            Section::make('Sales Data')
                                ->schema([


                                    Grid::make(4)
                                        ->schema([

                                            Select::make('division_id')
                                                ->label('Division')
                                                ->native(false)
                                                ->options(Division::whereIsActive(1)->pluck('division_name', 'id')),

                                        ]),
                                ])
                                ->compact(),

                            Section::make('Batch Status')
                                ->schema([

                                    Grid::make(4)
                                        ->schema([

                                            ToggleButtons::make('is_batch')
                                                ->label('Batch handled?')
                                                ->boolean()
                                                ->grouped(),

                                        ]),

                                ])
                                ->compact(),

                            Section::make('BoM Status')
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

                                ])
                                ->compact(),

                            // Section::make('Price')
                            //     ->schema([

                            //         Grid::make(4)
                            //             ->schema([

                            //                 TextInput::make('price')
                            //                     ->label('Harga Barang')
                            //                     ->numeric(),

                            //             ]),


                            //     ])
                            //     ->compact(),

                            Section::make('Dimensions')
                                ->schema([

                                    Grid::make(4)
                                        ->schema([

                                            Select::make('base_uom_id')
                                                ->label('Base UoM')
                                                ->required()
                                                ->native(false)
                                                ->options(Uom::whereIsActive(1)->pluck('uom', 'id')),

                                        ]),

                                    Grid::make(4)
                                        ->schema([

                                            Select::make('weight_unit_id')
                                                ->label('Weight Unit')
                                                ->native(false)
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


                                ])
                                ->compact(),

                            Section::make('Status')
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
                                ])
                                ->compact()
                                ->collapsible(),

                        ]),

                    Tab::make('Plant Data')
                        // ->icon('heroicon-o-user-group')
                        // ->disabled(fn(Get $get) => $get('material_type_id') === null)
                        ->schema([

                            Repeater::make('materialMasterPlants')
                                ->label(' ')
                                ->relationship()
                                ->schema([

                                    Section::make('Material Master Plant')
                                        ->schema([

                                            Grid::make(4)
                                                ->schema([

                                                    Select::make('plant_id')
                                                        ->label('Plant')
                                                        ->distinct()
                                                        ->required()
                                                        ->native(false)
                                                        ->options(Plant::whereIsActive(1)->pluck('plant_name', 'id'))
                                                        ->live(),
                                                    // ->afterStateUpdated(function (Get $get) {
                                                    //     dd($get('material_master_id'));
                                                    // }),

                                                ]),

                                        ]),

                                    Section::make('Stock Requirements')
                                        ->schema([
                                            Grid::make(4)
                                                ->schema([

                                                    TextInput::make('safety_stock')
                                                        ->label('Safety Stock')
                                                        ->numeric(),

                                                    // TextInput::make('minimal_safety_stock')
                                                    //     ->label('Minimal Safety Stock')
                                                    //     ->numeric(),

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
                                                        ->native(false)
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
                                                        ->native(false)
                                                        ->options(TemperatureCondition::whereIsActive(1)->pluck('temperature_condition_desc', 'id')),

                                                ]),

                                            Grid::make(4)
                                                ->schema([

                                                    Select::make('storage_condition_id')
                                                        ->label('Storage Condition')
                                                        // ->required()
                                                        ->native(false)
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

                                    Hidden::make('is_active')
                                        ->default(1),
                                ])
                                ->defaultItems(0)
                                // ->maxItems(1)
                                ->orderColumn('sort')

                        ]),

                    Tab::make('Sales Data')
                        // ->icon('heroicon-o-user-group')
                        // ->disabled(fn(Get $get) => $get('material_type_id') === null)
                        ->schema([

                            Repeater::make('allMaterialMasterSales')
                                ->label(' ')
                                ->relationship()
                                ->schema([

                                    Section::make('Sales Area')
                                        ->schema([

                                            Grid::make(2)
                                                ->schema([

                                                    Select::make('sales_organization_id')
                                                        ->label('Sales Organization')
                                                        ->inlineLabel()
                                                        ->options(SalesOrganization::where('is_active', 1)->pluck('sales_organization_name', 'id'))
                                                        ->required()
                                                        ->disabled()
                                                        ->dehydrated()
                                                        ->default(1)
                                                        ->native(false),

                                                ]),

                                            Grid::make(2)
                                                ->schema([

                                                    Select::make('distribution_channel_id')
                                                        ->label('Distribution Channel')
                                                        ->inlineLabel()
                                                        ->options(DistributionChannel::where('is_active', 1)->pluck('distribution_channel_name', 'id'))
                                                        ->required()
                                                        ->native(false)
                                                        ->distinct(),

                                                ]),

                                            Grid::make(2)
                                                ->schema([

                                                    Select::make('division_id')
                                                        ->label('Division')
                                                        ->inlineLabel()
                                                        ->options(Division::where('is_active', 1)->pluck('division_name', 'id'))
                                                        ->required()
                                                        ->native(false),

                                                ]),

                                        ])->compact(),

                                    // Section::make('Accounting Data')
                                    //     ->schema([

                                    //         Grid::make(2)
                                    //             ->schema([

                                    //                 Select::make('account_assignment_group_id')
                                    //                     ->label('Account Assignment Group')
                                    //                     ->inlineLabel()
                                    //                     ->options(AccountAssignmentGroup::where('is_active', 1)->pluck('account_assignment_group_desc', 'id'))
                                    //                     // ->required()
                                    //                     ->native(false),

                                    //             ]),

                                    //         Grid::make(2)
                                    //             ->schema([

                                    //                 Select::make('tax_classification_id')
                                    //                     ->label('Tax Classification')
                                    //                     ->inlineLabel()
                                    //                     ->options(TaxClassification::where('is_active', 1)->pluck('tax_classification_desc', 'id'))
                                    //                     // ->required()
                                    //                     ->native(false),

                                    //             ]),
                                    //     ])->compact(),

                                    // Section::make('Plant')
                                    //     ->schema([

                                    //         Grid::make(4)
                                    //             ->schema([

                                    //                 Select::make('plant_id')
                                    //                     ->label('Delivering Plant')
                                    //                     ->required()
                                    //                     ->native()
                                    //                     ->options(Plant::whereIsActive(1)->pluck('plant_name', 'id')),

                                    //             ]),

                                    //         Grid::make(4)
                                    //             ->schema([

                                    //                 Select::make('material_group_id')
                                    //                     ->label('Material Group')
                                    //                     ->required()
                                    //                     ->native()
                                    //                     ->options(MaterialGroup::whereIsActive(1)->pluck('material_group_desc', 'id')),

                                    //             ])

                                    //     ]),

                                    Hidden::make('is_active')
                                        ->default(1),
                                ])
                                ->defaultItems(0)
                                // ->maxItems(1)
                                ->orderColumn('sort')

                        ]),

                ])->contained(false),

        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Status', [

                    IconColumn::make('is_active')
                        ->label('Status')
                        ->boolean()
                        ->sortable()
                        ->alignCenter(),

                ])
                    ->alignCenter(),

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
                Tables\Actions\CreateAction::make()
                    ->icon('heroicon-o-plus'),

                // ImportAction::make()
                //     ->label('Import')
                //     ->importer(MaterialMasterImporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                        // Tables\Actions\DeleteAction::make(),

                        Action::make('nonaktif')
                            ->label('Inactive')
                            ->color('danger')
                            ->icon('heroicon-o-x-circle')
                            ->requiresConfirmation()
                            ->action(function ($record) {

                                $cekmatplant = MaterialMasterPlant::where('material_master_id', $record->id)->pluck('id')->toArray();
                                $cekmatsales = MaterialMasterSales::where('material_master_id', $record->id)->pluck('id')->toArray();

                                // dd($cekmatplant, $cekmatsales, $cekbpvend);

                                MaterialMasterPlant::whereIn('id', $cekmatplant)->update(['is_active' => 0]);

                                MaterialMasterSales::whereIn('id', $cekmatsales)->update(['is_active' => 0]);

                                $data['is_active'] = 0;
                                $record->update($data);

                                return $record;

                                Notification::make()
                                    ->title('Status Material Master telah diubah menjadi Inactive')
                                    ->color('danger')
                                    ->send();
                            }),

                        Action::make('aktif')
                            ->label('Activate')
                            ->color('success')
                            ->icon('heroicon-o-check-circle')
                            ->requiresConfirmation()
                            ->form([

                                Checkbox::make('massall')
                                    ->label('Also activate all related Material Masters?'),

                            ])
                            ->action(function ($record) {

                                $cekmatplant = MaterialMasterPlant::where('material_master_id', $record->id)->pluck('id')->toArray();
                                $cekmatsales = MaterialMasterSales::where('material_master_id', $record->id)->pluck('id')->toArray();

                                // dd($cekmatplant, $cekmatsales, $cekbpvend);

                                MaterialMasterPlant::whereIn('id', $cekmatplant)->update(['is_active' => 1]);

                                MaterialMasterSales::whereIn('id', $cekmatsales)->update(['is_active' => 1]);

                                $data['is_active'] = 1;
                                $record->update($data);

                                return $record;

                                Notification::make()
                                    ->title('Status Material Master telah diubah menjadi Active')
                                    ->color('danger')
                                    ->send();
                            }),

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
                        ->successRedirectUrl(fn(Model $replica): string => route('filament.submonitoring.material-master.resources.material-masters.edit', $replica)),


                ]),

                // RelationManagerAction::make('matplant')
                //     ->label('Plant')
                //     ->icon('heroicon-m-arrow-right-end-on-rectangle')
                //     ->button()
                //     ->outlined()
                //     ->modalWidth('full')
                //     ->modalSubmitActionLabel('Save')
                //     ->relationManager(MaterialMasterPlantsRelationManager::make()),

                // RelationManagerAction::make('matsales')
                //     ->label('Sales')
                //     ->icon('heroicon-m-arrow-right-end-on-rectangle')
                //     ->button()
                //     ->outlined()
                //     ->modalWidth('full')
                //     ->modalSubmitActionLabel('Save')
                //     ->relationManager(AllMaterialMasterSalesRelationManager::make()),

                // RelationManagerAction::make('bomheader')
                //     ->label('BoM')
                //     ->icon('heroicon-m-queue-list')
                //     ->button()
                //     ->outlined()
                //     ->modalWidth('full')
                //     ->modalSubmitActionLabel('Save')
                //     ->hidden(fn($record) => $record->is_bom_header == null)
                //     ->relationManager(BomHeadersRelationManager::make()),

            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),

                Tables\Actions\BulkAction::make('massinactivate')
                    ->label(__('Mass Inactive'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-x-circle')
                    ->modalIconColor('danger')
                    ->modalHeading('Mass Inactive?')
                    ->action(
                        function (Collection $records, array $data) {

                            $records->each(
                                function ($record) {

                                    $cekmatplant = MaterialMasterPlant::where('material_master_id', $record->id)->pluck('id')->toArray();
                                    $cekmatsales = MaterialMasterSales::where('material_master_id', $record->id)->pluck('id')->toArray();

                                    // dd($cekmatplant, $cekmatsales, $cekbpvend);

                                    MaterialMasterPlant::whereIn('id', $cekmatplant)->update(['is_active' => 0]);

                                    MaterialMasterSales::whereIn('id', $cekmatsales)->update(['is_active' => 0]);

                                    $data['is_active'] = 0;
                                    $record->update($data);
                                    return $record;
                                }
                            );
                        }
                    ),

                Tables\Actions\BulkAction::make('massactivate')
                    ->label(__('Mass Activate'))
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('success')
                    ->modalHeading('Mass Activate?')
                    ->form([

                        Checkbox::make('massall')
                            ->label('Also change all related Business Partners?'),

                    ])
                    ->action(
                        function (Collection $records, array $data) {

                            // dd($data['massall']);

                            if ($data['massall'] ==  true) {
                                $records->each(
                                    function ($record) {

                                        $cekmatplant = MaterialMasterPlant::where('material_master_id', $record->id)->pluck('id')->toArray();
                                        $cekmatsales = MaterialMasterSales::where('material_master_id', $record->id)->pluck('id')->toArray();

                                        // dd($cekmatplant, $cekmatsales, $cekbpvend);

                                        MaterialMasterPlant::whereIn('id', $cekmatplant)->update(['is_active' => 1]);

                                        MaterialMasterSales::whereIn('id', $cekmatsales)->update(['is_active' => 1]);

                                        $data['is_active'] = 1;
                                        $record->update($data);
                                        return $record;
                                    }
                                );
                            } elseif ($data['massall'] ==  false) {
                                $records->each(
                                    function ($record) {

                                        $data['is_active'] = 1;
                                        $record->update($data);
                                        return $record;
                                    }
                                );
                            }
                        }
                    ),

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

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewMaterialMaster::class,
            EditMaterialMaster::class,
        ]);
    }
}
