<?php

namespace App\Filament\Exports;

use App\Models\JournalEntry;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class JournalEntryExporter extends Exporter
{
    protected static ?string $model = JournalEntry::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('sort'),
            ExportColumn::make('material_document_item_id'),
            ExportColumn::make('module_aaa_id'),
            ExportColumn::make('debit_credit_id'),
            ExportColumn::make('gl_account_id'),
            ExportColumn::make('quantity'),
            ExportColumn::make('amount'),
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
        $body = 'Your journal entry export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
