<?php

namespace App\Filament\Exports;

use App\Models\BusinessPartnerCompany;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class BusinessPartnerCompanyExporter extends Exporter
{
    protected static ?string $model = BusinessPartnerCompany::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('sort'),
            ExportColumn::make('business_partner_id'),
            ExportColumn::make('company_code_id'),
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
        $body = 'Your business partner company export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
