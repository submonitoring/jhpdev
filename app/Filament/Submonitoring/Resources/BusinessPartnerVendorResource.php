<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\BusinessPartnerVendorExporter;
use App\Filament\Submonitoring\Clusters\BusinessPartner;
use App\Filament\Submonitoring\Resources\BusinessPartnerVendorResource\Pages;
use App\Filament\Submonitoring\Resources\BusinessPartnerVendorResource\RelationManagers;
use App\Models\BusinessPartner as ModelsBusinessPartner;
use App\Models\BusinessPartnerVendor;
use App\Models\CompanyCode;
use App\Models\PurchasingOrganization;
use Filament\Forms;
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

class BusinessPartnerVendorResource extends Resource
{
    protected static ?string $model = BusinessPartnerVendor::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Vendor';

    protected static ?string $pluralModelLabel = 'Vendor';

    protected static ?string $navigationLabel = 'Vendor';

    protected static ?int $navigationSort = 822000040;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = BusinessPartner::class;

    // protected static ?string $navigationGroup = 'System';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::VendorFormSchema())->columns(1);
    }

    public static function VendorFormSchema(): array
    {
        return [
            Section::make('Purchasing Data')
                ->schema([

                    Grid::make(2)
                        ->schema([

                            Select::make('purchasing_organization_id')
                                ->label('Purchasing Organization')
                                ->inlineLabel()
                                ->options(PurchasingOrganization::where('is_active', 1)->pluck('purchasing_organization_name', 'id'))
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

                ColumnGroup::make('Purchasing Area', [

                    TextColumn::make('purchasingOrganization.purchasing_organization_name')
                        ->label('Purchasing Organization')
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
                    ->exporter(BusinessPartnerVendorExporter::class),

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
            'index' => Pages\ListBusinessPartnerVendors::route('/'),
            'create' => Pages\CreateBusinessPartnerVendor::route('/create'),
            'view' => Pages\ViewBusinessPartnerVendor::route('/{record}'),
            'edit' => Pages\EditBusinessPartnerVendor::route('/{record}/edit'),
        ];
    }
}
