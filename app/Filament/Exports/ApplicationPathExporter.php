<?php

namespace App\Filament\Exports;

use App\Models\ApplicationPath;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ApplicationPathExporter extends Exporter
{
    protected static ?string $model = ApplicationPath::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('application_name_id'),
            ExportColumn::make('module_aaa_id'),
            ExportColumn::make('module_baa_id'),
            ExportColumn::make('module_caa_id'),
            ExportColumn::make('module_activity_type_id'),
            ExportColumn::make('module_activity_id'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your application path export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
