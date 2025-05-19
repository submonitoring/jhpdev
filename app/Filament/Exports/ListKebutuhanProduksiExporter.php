<?php

namespace App\Filament\Exports;

use App\Models\JournalEntry;
use App\Models\ListKebutuhanProduksi;
use App\Models\MaterialMasterPlant;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ListKebutuhanProduksiExporter extends Exporter
{
    protected static ?string $model = MaterialMasterPlant::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('materialMaster.material_desc'),
            ExportColumn::make('plant.plant_name'),
            ExportColumn::make('safety_stock'),
            ExportColumn::make('available_stock')
                ->state(function ($record) {
                    $getjournalentriesdebit = JournalEntry::where('material_master_id', $record->material_master_id)
                        ->where('plant_id', $record->plant_id)
                        ->where('debit_credit_id', 1)
                        ->where('gl_account_group_id', 1)?->sum('quantity');

                    $getjournalentriescredit = JournalEntry::where('material_master_id', $record->material_master_id)
                        ->where('plant_id', $record->plant_id)
                        ->where('debit_credit_id', 2)
                        ->where('gl_account_group_id', 1)?->sum('quantity');

                    return ($getjournalentriesdebit - $getjournalentriescredit);
                }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your material master plant export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
