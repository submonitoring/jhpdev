<?php

namespace App\Filament\Exports;

use App\Models\MaterialMasterPlant;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MaterialMasterPlantExporter extends Exporter
{
    protected static ?string $model = MaterialMasterPlant::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('material_master_id'),
            ExportColumn::make('plant_id'),
            ExportColumn::make('safety_stock'),
            ExportColumn::make('minimal_safety_stock'),
            ExportColumn::make('con'),
            ExportColumn::make('is_extenal_batch'),
            ExportColumn::make('is_internal_batch'),
            ExportColumn::make('procurement_type_id'),
            ExportColumn::make('temperature_condition_id'),
            ExportColumn::make('storage_condition_id'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
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
