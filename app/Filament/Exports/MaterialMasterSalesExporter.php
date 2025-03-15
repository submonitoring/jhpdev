<?php

namespace App\Filament\Exports;

use App\Models\MaterialMasterSales;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MaterialMasterSalesExporter extends Exporter
{
    protected static ?string $model = MaterialMasterSales::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('material_master_id'),
            ExportColumn::make('sales_organization_id'),
            ExportColumn::make('distribution_channel_id'),
            ExportColumn::make('division_id'),
            ExportColumn::make('account_assignment_group_id'),
            ExportColumn::make('tax_classification_id'),
            ExportColumn::make('plant_id'),
            ExportColumn::make('material_group_id'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your material master sales export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
