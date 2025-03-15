<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\BatchMasterMaterialMasterExporter;
use App\Filament\Submonitoring\Clusters\Batch;
use App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource\Pages;
use App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource\RelationManagers;
use App\Models\BatchMaster;
use App\Models\BatchMasterMaterialMaster;
use App\Models\MaterialMaster;
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

class BatchMasterMaterialMasterResource extends Resource
{
    protected static ?string $model = BatchMasterMaterialMaster::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Batch Master Material Master';

    protected static ?string $pluralModelLabel = 'Batch Master Material Master';

    protected static ?string $navigationLabel = 'Batch Master Material Master';

    protected static ?int $navigationSort = 827000020;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = Batch::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::BatchMasterMaterialMasterFormSchema());
    }

    public static function BatchMasterMaterialMasterFormSchema(): array
    {
        return [];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Batch Master Material Master', [

                    TextColumn::make('batchMaster.batch_number')
                        ->label('Batch Number')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('materialMaster.material_desc')
                        ->label('Material Master')
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

                        SelectConstraint::make('batch_master_id')
                            ->label('Batch Master')
                            ->options(BatchMaster::whereIsActive(1)->pluck('batch_number', 'id'))
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('material_master_id')
                            ->label('Material Master')
                            ->options(MaterialMaster::whereIsActive(1)->pluck('material_desc', 'id'))
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
                //     ->importer(BatchMasterMaterialMasterImporter::class)
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
                    ->exporter(BatchMasterMaterialMasterExporter::class),

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

                            $active = BatchMasterMaterialMaster::where('id', $record->id)->first();
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

                            $inactive = BatchMasterMaterialMaster::where('id', $record->id)->first();
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
            'index' => Pages\ListBatchMasterMaterialMasters::route('/'),
            'create' => Pages\CreateBatchMasterMaterialMaster::route('/create'),
            'view' => Pages\ViewBatchMasterMaterialMaster::route('/{record}'),
            'edit' => Pages\EditBatchMasterMaterialMaster::route('/{record}/edit'),
        ];
    }
}
