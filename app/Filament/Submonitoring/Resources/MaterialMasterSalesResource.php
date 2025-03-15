<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\MaterialMasterSalesExporter;
use App\Filament\Imports\MaterialMasterSalesImporter;
use App\Filament\Submonitoring\Clusters\MaterialMaster;
use App\Filament\Submonitoring\Resources\MaterialMasterSalesResource\Pages;
use App\Filament\Submonitoring\Resources\MaterialMasterSalesResource\RelationManagers;
use App\Models\AccountAssignmentGroup;
use App\Models\DistributionChannel;
use App\Models\Division;
use App\Models\MaterialGroup;
use App\Models\MaterialMasterSales;
use App\Models\Plant;
use App\Models\SalesOrganization;
use App\Models\TaxClassification;
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

class MaterialMasterSalesResource extends Resource
{
    protected static ?string $model = MaterialMasterSales::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Material Master Sales';

    protected static ?string $pluralModelLabel = 'Material Master Sales';

    protected static ?string $navigationLabel = 'Material Master Sales';

    protected static ?int $navigationSort = 824000040;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = MaterialMaster::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::MaterialMasterSalesFormSchema())->columns(1);
    }

    public static function MaterialMasterSalesFormSchema(): array
    {
        return [

            Section::make('Sales Area')
                ->schema([

                    Grid::make(2)
                        ->schema([

                            Select::make('sales_organization_id')
                                ->label('Sales Organization')
                                ->inlineLabel()
                                ->options(SalesOrganization::where('is_active', 1)->pluck('sales_organization_name', 'id'))
                                ->required()
                                ->native(false),

                        ]),

                    Grid::make(2)
                        ->schema([

                            Select::make('distribution_channel_id')
                                ->label('Distribution Channel')
                                ->inlineLabel()
                                ->options(DistributionChannel::where('is_active', 1)->pluck('distribution_channel_name', 'id'))
                                ->required()
                                ->native(false),

                        ]),

                    Grid::make(2)
                        ->schema([

                            Select::make('division_id')
                                ->label('Division')
                                ->inlineLabel()
                                ->options(Division::whereIsActive(1)->pluck('division_name', 'id'))
                                ->required()
                                ->native(false),


                        ]),

                ])->compact(),

            Section::make('Accounting Data')
                ->schema([

                    Grid::make(2)
                        ->schema([

                            Select::make('account_assignment_group_id')
                                ->label('Account Assignment Group')
                                ->inlineLabel()
                                ->options(AccountAssignmentGroup::where('is_active', 1)->pluck('account_assignment_group_desc', 'id'))
                                // ->required()
                                ->native(false),

                        ]),

                    Grid::make(2)
                        ->schema([

                            Select::make('tax_classification_id')
                                ->label('Tax Classification')
                                ->inlineLabel()
                                ->options(TaxClassification::where('is_active', 1)->pluck('tax_classification_desc', 'id'))
                                // ->required()
                                ->native(false),

                        ]),
                ])->compact(),

            Section::make('Plant')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('plant_id')
                                ->label('Plant')
                                ->required()
                                ->native()
                                ->options(Plant::whereIsActive(1)->pluck('plant_name', 'id')),

                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('material_group_id')
                                ->label('Material Group')
                                ->required()
                                ->native()
                                ->options(MaterialGroup::whereIsActive(1)->pluck('material_group_desc', 'id')),

                        ])

                ]),

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

                ColumnGroup::make('Sales Area', [

                    TextColumn::make('salesOrganization.sales_organization_name')
                        ->label('Sales Organization')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('distributionChannel.distribution_channel_name')
                        ->label('Distribution Channel')
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
                            ->label('Material Master Sales')
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
                    ->importer(MaterialMasterSalesImporter::class),
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
                    ->exporter(MaterialMasterSalesExporter::class)
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
            'index' => Pages\ListMaterialMasterSales::route('/'),
            'create' => Pages\CreateMaterialMasterSales::route('/create'),
            'view' => Pages\ViewMaterialMasterSales::route('/{record}'),
            'edit' => Pages\EditMaterialMasterSales::route('/{record}/edit'),
        ];
    }
}
