<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\SalesAreaExporter;
use App\Filament\Imports\SalesAreaImporter;
use App\Filament\Submonitoring\Clusters\SdOrgStruct;
use App\Filament\Submonitoring\Resources\SalesAreaResource\Pages;
use App\Filament\Submonitoring\Resources\SalesAreaResource\RelationManagers;
use App\Filament\Submonitoring\Resources\SalesAreaResource\RelationManagers\SalesOfficesRelationManager;
use App\Models\DistributionChannel;
use App\Models\Division;
use App\Models\SalesArea;
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

class SalesAreaResource extends Resource
{
    protected static ?string $model = SalesArea::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Sales Area';

    protected static ?string $pluralModelLabel = 'Sales Area';

    protected static ?string $navigationLabel = 'Sales Area';

    protected static ?int $navigationSort = 814000100;

    // protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $cluster = SdOrgStruct::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::SalesAreaFormSchema());
    }

    public static function SalesAreaFormSchema(): array
    {
        return [

            Section::make('Sales Area')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('sales_organization_id')
                                ->label('Sales Organization')
                                ->options(SalesOrganization::whereIsActive(1)->pluck('sales_organization_name', 'id')),

                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('distribution_channel_id')
                                ->label('Distribution Channel')
                                ->options(DistributionChannel::whereIsActive(1)->pluck('distribution_channel_name', 'id')),

                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('division_id')
                                ->label('Division')
                                ->options(Division::whereIsActive(1)->pluck('division_name', 'id')),

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

                ColumnGroup::make('Sales Area', [

                    TextColumn::make('salesOrganization.sales_organization_name')
                        ->label('Sales Organization')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('distributionChannel.distribution_channel_name')
                        ->label('Distribution Channel')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('division.division_name')
                        ->label('Division')
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

                        SelectConstraint::make('sales_organization_id')
                            ->label('Sales Organization')
                            ->options(SalesOrganization::whereIsActive(1)->pluck('sales_organization_name', 'id'))
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('distribution_channel_id')
                            ->label('Distribution Channel')
                            ->options(DistributionChannel::whereIsActive(1)->pluck('distribution_channel_name', 'id'))
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('division_id')
                            ->label('Division')
                            ->options(Division::whereIsActive(1)->pluck('division_name', 'id'))
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
                    ->importer(SalesAreaImporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                    ])->dropdown(false),
                ]),

                RelationManagerAction::make('assignsalesoffice')
                    ->label('Assign Sales Office')
                    ->icon('heroicon-m-arrow-right-end-on-rectangle')
                    ->button()
                    ->outlined()
                    ->modalWidth('full')
                    ->modalSubmitActionLabel('Save')
                    ->relationManager(SalesOfficesRelationManager::make()),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(SalesAreaExporter::class),

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
            'index' => Pages\ListSalesAreas::route('/'),
            'create' => Pages\CreateSalesArea::route('/create'),
            'view' => Pages\ViewSalesArea::route('/{record}'),
            'edit' => Pages\EditSalesArea::route('/{record}/edit'),
        ];
    }
}
