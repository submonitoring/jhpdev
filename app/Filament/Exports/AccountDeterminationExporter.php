<?php

namespace App\Filament\Exports;

use App\Models\AccountDetermination;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AccountDeterminationExporter extends Exporter
{
    protected static ?string $model = AccountDetermination::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('module_aaa_id'),
            ExportColumn::make('document_type_id'),
            ExportColumn::make('transaction_type_id'),
            ExportColumn::make('material_type_id'),
            ExportColumn::make('movement_type_id'),
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
        $body = 'Your account determination export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
