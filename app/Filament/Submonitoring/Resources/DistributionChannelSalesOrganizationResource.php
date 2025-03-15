<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\DistributionChannelSalesOrganizationExporter;
use App\Filament\Submonitoring\Clusters\SdOrgStruct;
use App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource\Pages;
use App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource\RelationManagers;
use App\Models\DistributionChannel;
use App\Models\DistributionChannelSalesOrganization;
use App\Models\SalesOrganization;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Unique;

class DistributionChannelSalesOrganizationResource extends Resource
{
    protected static ?string $model = DistributionChannelSalesOrganization::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Dist Channel Sales Org';

    protected static ?string $pluralModelLabel = 'Dist Channel Sales Org';

    protected static ?string $navigationLabel = 'Dist Channel Sales Org';

    protected static ?int $navigationSort = 814000040;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = SdOrgStruct::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::DistChannelSalesOrgFormSchema());
    }

    public static function DistChannelSalesOrgFormSchema(): array
    {
        return [];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Dist Channel Sales Org', [

                    TextColumn::make('distributionChannel.distribution_channel_name')
                        ->label('Distribution Channel')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('salesOrganization.sales_organization_name')
                        ->label('Sales Organization')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),
                ]),

                ColumnGroup::make('Status', [

                    CheckboxColumn::make('isactive')
                        ->label('Status')
                        ->sortable()
                        ->alignCenter(),
                ]),

            ])
            ->recordUrl(null)
            ->searchOnBlur()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        SelectConstraint::make('distribution_channel_id')
                            ->label('Distribution Channel')
                            ->options(DistributionChannel::whereIsActive(1)->pluck('distribution_channel_name', 'id'))
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('sales_organization_id')
                            ->label('Sales Organization')
                            ->options(SalesOrganization::whereIsActive(1)->pluck('sales_organization_name', 'id'))
                            ->icon(false)
                            ->nullable(),

                        BooleanConstraint::make('isactive')
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
                // Tables\Actions\CreateAction::make(),

                // ImportAction::make()
                //     ->label('Import')
                //     ->importer(DistChannelSalesOrgImporter::class)
            ])
            ->actions([
                // ActionGroup::make([
                //     ActionGroup::make([
                //         Tables\Actions\ViewAction::make(),
                //         Tables\Actions\DetachAction::make(),
                //         Tables\Actions\EditAction::make(),
                //     ])->dropdown(false),

                // ]),

            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(DistributionChannelSalesOrganizationExporter::class),

                BulkAction::make('setactive')
                    ->label(__('Set Active'))
                    ->color('success')
                    // ->visible(fn($livewire): bool => $livewire->activeTab === 'Aktif')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Simpan data santri tinggal kelas?')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $active = DistributionChannelSalesOrganization::where('id', $record->id)->first();
                            $active->isactive = 1;
                            $active->save();

                            Notification::make()
                                ->success()
                                ->title('Status telah diupdate')
                                ->icon('heroicon-o-check-circle')
                                // ->persistent()
                                ->color('Success')
                                // ->actions([
                                //     Action::make('view')
                                //         ->button(),
                                //     Action::make('undo')
                                //         ->color('secondary'),
                                // ])
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('setinactive')
                    ->label(__('Set Inactive'))
                    ->color('danger')
                    // ->visible(fn($livewire): bool => $livewire->activeTab === 'Aktif')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Simpan data santri tinggal kelas?')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $inactive = DistributionChannelSalesOrganization::where('id', $record->id)->first();
                            $inactive->isactive = 0;
                            $inactive->save();

                            Notification::make()
                                ->success()
                                ->title('Status telah diupdate')
                                ->icon('heroicon-o-check-circle')
                                // ->persistent()
                                ->color('Success')
                                // ->actions([
                                //     Action::make('view')
                                //         ->button(),
                                //     Action::make('undo')
                                //         ->color('secondary'),
                                // ])
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

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
            'index' => Pages\ListDistributionChannelSalesOrganizations::route('/'),
            'create' => Pages\CreateDistributionChannelSalesOrganization::route('/create'),
            'view' => Pages\ViewDistributionChannelSalesOrganization::route('/{record}'),
            'edit' => Pages\EditDistributionChannelSalesOrganization::route('/{record}/edit'),
        ];
    }
}
