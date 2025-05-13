<?php

namespace App\Filament\Exports;

use App\Models\MaterialDocument;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MaterialDocumentExporter extends Exporter
{
    protected static ?string $model = MaterialDocument::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('document_date'),
            ExportColumn::make('transaction_type_id'),
            ExportColumn::make('transaction_reference_id'),
            ExportColumn::make('business_partner_id'),
            ExportColumn::make('document_type_id'),
            ExportColumn::make('number_range_id'),
            ExportColumn::make('document_number'),
            ExportColumn::make('text_header'),
            ExportColumn::make('unique'),
            ExportColumn::make('record_title'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your material document export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
