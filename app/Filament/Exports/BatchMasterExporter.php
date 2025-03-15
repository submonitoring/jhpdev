<?php

namespace App\Filament\Exports;

use App\Models\BatchMaster;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class BatchMasterExporter extends Exporter
{
    protected static ?string $model = BatchMaster::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('batch_source_id'),
            ExportColumn::make('number_range_id'),
            ExportColumn::make('batch_number'),
            ExportColumn::make('business_partner_id'),
            ExportColumn::make('production_date'),
            ExportColumn::make('expiration_date'),
            ExportColumn::make('is_external'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your batch master export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
