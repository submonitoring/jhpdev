<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\BusinessPartnerCustomerExporter;
use App\Filament\Imports\BusinessPartnerCustomerImporter;
use App\Filament\Submonitoring\Clusters\BusinessPartner;
use App\Filament\Submonitoring\Resources\BusinessPartnerCustomerResource\Pages;
use App\Filament\Submonitoring\Resources\BusinessPartnerCustomerResource\RelationManagers;
use App\Models\BusinessPartner as ModelsBusinessPartner;
use App\Models\BusinessPartnerCustomer;
use App\Models\CompanyCode;
use App\Models\DistributionChannel;
use App\Models\Division;
use App\Models\SalesOrganization;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class BusinessPartnerCustomerResource extends Resource
{
    protected static ?string $model = BusinessPartnerCustomer::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Customer';

    protected static ?string $pluralModelLabel = 'Customer';

    protected static ?string $navigationLabel = 'Customer';

    protected static ?int $navigationSort = 822000020;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = BusinessPartner::class;

    // protected static ?string $navigationGroup = 'System';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::CustomerFormSchema())->columns(1);
    }

    public static function CustomerFormSchema(): array
    {
        return [
            Section::make('Sales Area Data')
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
                                ->options(Division::where('is_active', 1)->pluck('division_name', 'id'))
                                ->required()
                                ->native(false),

                        ]),

                ])->compact(),

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

                ColumnGroup::make('Business Partner', [

                    TextColumn::make('businessPartner.title.title')
                        ->label('Title')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('businessPartner.name_1')
                        ->label('Name')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

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
            ->headerActions([])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Action::make('nonaktif')
                        ->label('Inactive')
                        ->color('danger')
                        ->icon('heroicon-o-x-circle')
                        ->requiresConfirmation()
                        ->action(function ($record) {


                            $data['is_active'] = 0;
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->title('Status Business Partner Customer telah diubah menjadi Inactive')
                                ->color('danger')
                                ->send();
                        }),
                    Action::make('aktif')
                        ->label('Activate')
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->requiresConfirmation()
                        ->action(function ($record) {

                            ModelsBusinessPartner::where('id', $record->business_partner_id)->update(['is_active' => 1]);

                            $data['is_active'] = 1;
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->title('Status Business Partner telah diubah menjadi Active')
                                ->color('success')
                                ->send();
                        }),
                ]),


            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([]),

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
                    ->action(
                        function (Collection $records, array $data) {

                            $records->each(
                                function ($record) {

                                    ModelsBusinessPartner::where('id', $record->business_partner_id)->update(['is_active' => 1]);

                                    $data['is_active'] = 1;
                                    $record->update($data);

                                    return $record;

                                    Notification::make()
                                        ->title('Status Business Partner telah diubah menjadi Active')
                                        ->color('success')
                                        ->send();
                                }
                            );
                        }
                    ),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(BusinessPartnerCustomerExporter::class),

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
            'index' => Pages\ListBusinessPartnerCustomers::route('/'),
            'create' => Pages\CreateBusinessPartnerCustomer::route('/create'),
            'view' => Pages\ViewBusinessPartnerCustomer::route('/{record}'),
            'edit' => Pages\EditBusinessPartnerCustomer::route('/{record}/edit'),
        ];
    }
}
