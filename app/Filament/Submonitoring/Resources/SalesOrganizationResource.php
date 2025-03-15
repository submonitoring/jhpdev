<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\SalesOrganizationExporter;
use App\Filament\Imports\SalesOrganizationImporter;
use App\Filament\Submonitoring\Clusters\SdOrgStruct;
use App\Filament\Submonitoring\Resources\SalesOrganizationResource\Pages;
use App\Filament\Submonitoring\Resources\SalesOrganizationResource\RelationManagers;
use App\Filament\Submonitoring\Resources\SalesOrganizationResource\RelationManagers\DistributionChannelsRelationManager;
use App\Filament\Submonitoring\Resources\SalesOrganizationResource\RelationManagers\DivisionsRelationManager;
use App\Models\CompanyCode;
use App\Models\Currency;
use App\Models\SalesOrganization;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalesOrganizationResource extends Resource
{
    protected static ?string $model = SalesOrganization::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Sales Organization';

    protected static ?string $pluralModelLabel = 'Sales Organization';

    protected static ?string $navigationLabel = 'Sales Organization';

    protected static ?int $navigationSort = 814000000;

    // protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $cluster = SdOrgStruct::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::SalesOrganizationFormSchema());
    }

    public static function SalesOrganizationFormSchema(): array
    {
        return [

            Section::make('Sales Organization')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('sales_organization')
                                ->label('Sales Organization')
                                ->required()
                                ->unique(SalesOrganization::class, ignoreRecord: true),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('sales_organization_name')
                                ->label('Name')
                                ->required(),

                        ]),

                ])
                ->compact(),

            Section::make('Company Code')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('company_code_id')
                                ->label('Company Code')
                                ->options(CompanyCode::whereIsActive(1)->pluck('company_code', 'id')),

                        ]),

                ])
                ->compact(),

            Section::make('Data')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('currency_id')
                                ->label('Currency')
                                ->options(Currency::whereIsActive(1)->pluck('currency', 'id')),

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

                ColumnGroup::make('Sales Organization', [

                    TextColumn::make('sales_organization')
                        ->label('Sales Organization')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('sales_organization_name')
                        ->label('Name')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Company Code', [

                    TextColumn::make('companyCode.company_code_name')
                        ->label('Company Code')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Data', [

                    TextColumn::make('currency.currency')
                        ->label('Currency')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),
                ]),

                ColumnGroup::make('Status', [

                    CheckboxColumn::make('is_active')
                        ->label('Status')
                        ->sortable()
                        ->alignCenter(),

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

                        TextConstraint::make('sales_organization')
                            ->label('Sales Organization')
                            ->nullable(),

                        TextConstraint::make('sales_organization_name')
                            ->label('Name')
                            ->nullable(),

                        SelectConstraint::make('company_code_id')
                            ->label('Company Code')
                            ->options(CompanyCode::whereIsActive(1)->pluck('company_code_name', 'id'))
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('currency_id')
                            ->label('Currency')
                            ->options(Currency::whereIsActive(1)->pluck('currency', 'id'))
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
                    ->importer(SalesOrganizationImporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                    ])->dropdown(false),
                ]),

                RelationManagerAction::make('assigndistchan')
                    ->label('Assign Dist. C.')
                    ->icon('heroicon-m-arrow-right-end-on-rectangle')
                    ->button()
                    ->outlined()
                    ->modalWidth('full')
                    ->modalSubmitActionLabel('Save')
                    ->relationManager(DistributionChannelsRelationManager::make()),

                RelationManagerAction::make('assigndiv')
                    ->label('Assign Div')
                    ->icon('heroicon-m-arrow-right-end-on-rectangle')
                    ->button()
                    ->outlined()
                    ->modalWidth('full')
                    ->modalSubmitActionLabel('Save')
                    ->relationManager(DivisionsRelationManager::make()),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(SalesOrganizationExporter::class),

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
            'index' => Pages\ListSalesOrganizations::route('/'),
            'create' => Pages\CreateSalesOrganization::route('/create'),
            'view' => Pages\ViewSalesOrganization::route('/{record}'),
            'edit' => Pages\EditSalesOrganization::route('/{record}/edit'),
        ];
    }
}
