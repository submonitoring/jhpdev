<?php

namespace App\Filament\Exports;

use App\Models\NumberRange;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class NumberRangeExporter extends Exporter
{
    protected static ?string $model = NumberRange::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('nr_object_id'),
            ExportColumn::make('number_range_interval'),
            ExportColumn::make('number_range_name'),
            ExportColumn::make('year'),
            ExportColumn::make('number'),
            ExportColumn::make('current_number'),
            ExportColumn::make('is_external'),
            ExportColumn::make('con'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your number range export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
