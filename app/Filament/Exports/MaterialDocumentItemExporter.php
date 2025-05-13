<?php

namespace App\Filament\Exports;

use App\Models\MaterialDocumentItem;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MaterialDocumentItemExporter extends Exporter
{
    protected static ?string $model = MaterialDocumentItem::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('sort'),
            ExportColumn::make('material_master_id'),
            ExportColumn::make('quantity'),
            ExportColumn::make('uom_id'),
            ExportColumn::make('movement_type_id'),
            ExportColumn::make('plant_id'),
            ExportColumn::make('material_document_id'),
            ExportColumn::make('text_item'),
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
        $body = 'Your material document item export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
