<?php

namespace App\Filament\Exports;

use App\Models\BusinessPartnerCustomer;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class BusinessPartnerCustomerExporter extends Exporter
{
    protected static ?string $model = BusinessPartnerCustomer::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('sort'),
            ExportColumn::make('business_partner_id'),
            ExportColumn::make('sales_organization_id'),
            ExportColumn::make('distribution_channel_id'),
            ExportColumn::make('division_id'),
            ExportColumn::make('account_assignment_group_id'),
            ExportColumn::make('tax_classification_id'),
            ExportColumn::make('currency_id'),
            ExportColumn::make('payment_term_id'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your business partner customer export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
