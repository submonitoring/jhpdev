<?php

namespace App\Filament\Exports;

use App\Models\MaterialMaster;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MaterialMasterExporter extends Exporter
{
    protected static ?string $model = MaterialMaster::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('number_range_id'),
            ExportColumn::make('material_number'),
            ExportColumn::make('material_type_id'),
            ExportColumn::make('industry_sector_id'),
            ExportColumn::make('material_group_id'),
            ExportColumn::make('division_id'),
            ExportColumn::make('material_desc'),
            ExportColumn::make('old_material_number'),
            ExportColumn::make('base_uom_id'),
            ExportColumn::make('weight_unit_id'),
            ExportColumn::make('gross_weight'),
            ExportColumn::make('net_weight'),
            ExportColumn::make('deletion_flag'),
            ExportColumn::make('price'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your material master export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
