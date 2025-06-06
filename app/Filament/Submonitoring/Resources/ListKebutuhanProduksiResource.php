<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\ListKebutuhanProduksiExporter;
use App\Filament\Submonitoring\Resources\ListKebutuhanProduksiResource\Pages;
use App\Filament\Submonitoring\Resources\ListKebutuhanProduksiResource\RelationManagers;
use App\Models\JournalEntry;
use App\Models\MaterialMaster;
use App\Models\MaterialMasterPlant;
use Asmit\ResizedColumn\HasResizableColumn;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\ExportBulkAction as ActionsExportBulkAction;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use TomatoPHP\FilamentDocs\Filament\Actions\DocumentAction;
use TomatoPHP\FilamentDocs\Services\Contracts\DocsVar;

class ListKebutuhanProduksiResource extends Resource
{

    protected static ?string $model = MaterialMasterPlant::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'List Kebutuhan Produksi';

    protected static ?string $pluralModelLabel = 'List Kebutuhan Produksi';

    protected static ?string $navigationLabel = 'List Kebutuhan Produksi';

    protected static ?int $navigationSort = 812000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = SubmonitoringClustersMaterialDocument::class;

    protected static ?string $navigationGroup = 'Reports';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    // protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->searchOnBlur()
            ->columns([

                // ColumnGroup::make('Status', [

                //     IconColumn::make('status_stock')
                //         ->label('Status Stock')
                //         ->default(function ($record) {
                //             $getjournalentriesdebit = JournalEntry::where('material_master_id', $record->material_master_id)
                //                 ->where('plant_id', $record->plant_id)
                //                 ->where('debit_credit_id', 1)
                //                 ->where('gl_account_group_id', 1)?->sum('quantity');

                //             $getjournalentriescredit = JournalEntry::where('material_master_id', $record->material_master_id)
                //                 ->where('plant_id', $record->plant_id)
                //                 ->where('debit_credit_id', 2)
                //                 ->where('gl_account_group_id', 1)?->sum('quantity');

                //             $availablestock = $getjournalentriesdebit - $getjournalentriescredit;
                //             if ($availablestock == null) {
                //                 return null;
                //             } elseif ($record->safety_stock > $availablestock) {

                //                 return ('>');
                //             } else {
                //                 return ('<');
                //             }
                //         })
                //         ->icon(function ($state) {

                //             if ($state == null) {
                //                 return null;
                //             } elseif ($state == '>') {

                //                 return ('heroicon-o-exclamation-circle');
                //             } elseif ($state == '<') {
                //                 return ('heroicon-o-check-circle');
                //             }
                //         })
                //         ->color(function ($state) {

                //             if ($state == null) {
                //                 return null;
                //             } elseif ($state == '>') {

                //                 return ('danger');
                //             } elseif ($state == '<') {
                //                 return ('success');
                //             }
                //         }),

                // ]),

                // TextColumn::make('materialMaster.material_desc')
                //     ->label('Material Description')
                //     ->searchable(isIndividual: true, isGlobal: false)
                //     ->copyable()
                //     ->copyableState(function ($state) {
                //         return ($state);
                //     })
                //     ->copyMessage('Tersalin')
                //     ->sortable(),

                BadgeableColumn::make('materialMaster.material_desc')
                    ->label('Material Description')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->sortable()
                    ->prefixBadges([
                        Badge::make('status_stock')
                            ->label(function ($record) {
                                $getjournalentriesdebit = JournalEntry::where('material_master_id', $record->material_master_id)
                                    ->where('plant_id', $record->plant_id)
                                    ->where('debit_credit_id', 1)
                                    ->where('gl_account_group_id', 1)?->sum('quantity');

                                $getjournalentriescredit = JournalEntry::where('material_master_id', $record->material_master_id)
                                    ->where('plant_id', $record->plant_id)
                                    ->where('debit_credit_id', 2)
                                    ->where('gl_account_group_id', 1)?->sum('quantity');

                                $availablestock = $getjournalentriesdebit - $getjournalentriescredit;
                                if ($availablestock == null) {
                                    return ' ';
                                } elseif ($record->safety_stock == $availablestock) {

                                    return ('=');
                                } elseif ($record->safety_stock > $availablestock) {

                                    return ('<');
                                } elseif ($record->safety_stock < $availablestock) {

                                    return ('>');
                                }
                            })
                            ->color(function ($record) {
                                $getjournalentriesdebit = JournalEntry::where('material_master_id', $record->material_master_id)
                                    ->where('plant_id', $record->plant_id)
                                    ->where('debit_credit_id', 1)
                                    ->where('gl_account_group_id', 1)?->sum('quantity');

                                $getjournalentriescredit = JournalEntry::where('material_master_id', $record->material_master_id)
                                    ->where('plant_id', $record->plant_id)
                                    ->where('debit_credit_id', 2)
                                    ->where('gl_account_group_id', 1)?->sum('quantity');

                                $availablestock = $getjournalentriesdebit - $getjournalentriescredit;
                                if ($availablestock == null) {
                                    return ' ';
                                } elseif ($record->safety_stock == $availablestock) {

                                    return ('warning');
                                } elseif ($record->safety_stock > $availablestock) {

                                    return ('danger');
                                } elseif ($record->safety_stock < $availablestock) {

                                    return ('success');
                                }
                            })
                    ])
                    ->suffixBadges([
                        Badge::make('plant_id')
                            ->label(fn($record) => $record->plant->plant_name)
                            ->color('null')
                    ])
                    ->separator(''),

                ColumnGroup::make('Safety Stock', [

                    TextColumn::make('safety_stock')
                        ->label('Safety Stock')
                        // ->searchable(isIndividual: true, isGlobal: false)
                        ->alignment(Alignment::End)
                        ->numeric()
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Available Stock', [

                    // TextColumn::make('available_stock')
                    //     ->label('Available Stock')
                    //     ->alignment(Alignment::End)
                    //     ->default(function ($record) {
                    //         $getjournalentriesdebit = JournalEntry::where('material_master_id', $record->material_master_id)
                    //             ->where('plant_id', $record->plant_id)
                    //             ->where('debit_credit_id', 1)
                    //             ->where('gl_account_group_id', 1)?->sum('quantity');

                    //         $getjournalentriescredit = JournalEntry::where('material_master_id', $record->material_master_id)
                    //             ->where('plant_id', $record->plant_id)
                    //             ->where('debit_credit_id', 2)
                    //             ->where('gl_account_group_id', 1)?->sum('quantity');

                    //         return ($getjournalentriesdebit - $getjournalentriescredit);
                    //     })
                    //     ->numeric(),

                    BadgeableColumn::make('available_stock')
                        ->label('Available Stock')
                        ->alignment(Alignment::End)
                        ->default(function ($record) {
                            $getjournalentriesdebit = JournalEntry::where('material_master_id', $record->material_master_id)
                                ->where('plant_id', $record->plant_id)
                                ->where('debit_credit_id', 1)
                                ->where('gl_account_group_id', 1)?->sum('quantity');

                            $getjournalentriescredit = JournalEntry::where('material_master_id', $record->material_master_id)
                                ->where('plant_id', $record->plant_id)
                                ->where('debit_credit_id', 2)
                                ->where('gl_account_group_id', 1)?->sum('quantity');

                            return ($getjournalentriesdebit - $getjournalentriescredit);
                        })
                        ->numeric()
                        ->suffixBadges([
                            Badge::make('uom_id')
                                ->label(fn($record) => $record->materialMaster->baseUom->uom)
                                ->color('null')
                        ])
                        ->separator(''),

                ]),

                // ColumnGroup::make('UoM', [

                //     TextColumn::make('materialMaster.baseUom.uom')
                //         ->label('UoM'),

                // ]),

                // TextColumn::make('plant.plant_name')
                //     ->label('Plant')
                //     ->searchable(isIndividual: true, isGlobal: false)
                //     ->copyable()
                //     ->copyableState(function ($state) {
                //         return ($state);
                //     })
                //     ->copyMessage('Tersalin')
                //     ->sortable(),

                ColumnGroup::make('Material Master Data', [

                    TextColumn::make('materialMaster.material_number')
                        ->label('Material Number')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('materialMaster.materialType.material_type_desc')
                        ->label('Material Type')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('materialMaster.materialGroup.material_group_desc')
                        ->label('Material Group')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

            ])
            ->defaultSort('material_desc')
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),

                // DocumentAction::make()
                //     ->vars(fn($record) => [
                //         DocsVar::make('$MATERIAL_DESC')
                //             ->value($record->material_desc),
                //         DocsVar::make('$PLANT_NAME')
                //             ->value($record->plant_name),
                //     ])
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),

                // ActionsExportBulkAction::make()
                //     ->exporter(ListKebutuhanProduksiExporter::class),
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
            'index' => Pages\ListListKebutuhanProduksis::route('/'),
            'create' => Pages\CreateListKebutuhanProduksi::route('/create'),
            'view' => Pages\ViewListKebutuhanProduksi::route('/{record}'),
            'edit' => Pages\EditListKebutuhanProduksi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {

        return parent::getEloquentQuery()->where('is_active', 1);
    }
}
