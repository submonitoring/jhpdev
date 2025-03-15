<?php

namespace App\Filament\Exports;

use App\Models\BusinessPartner;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class BusinessPartnerExporter extends Exporter
{
    protected static ?string $model = BusinessPartner::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('number_range_id'),
            ExportColumn::make('bp_number'),
            ExportColumn::make('bp_category_id'),
            ExportColumn::make('bp_role_id'),
            ExportColumn::make('vat_number'),
            ExportColumn::make('title_id'),
            ExportColumn::make('name_1'),
            ExportColumn::make('name_2'),
            ExportColumn::make('name_3'),
            ExportColumn::make('name_4'),
            ExportColumn::make('search_term'),
            ExportColumn::make('search_term2'),
            ExportColumn::make('telephone_number_1'),
            ExportColumn::make('telephone_number_1_ext'),
            ExportColumn::make('telephone_number_2'),
            ExportColumn::make('telephone_number_2_ext'),
            ExportColumn::make('fax_number_1'),
            ExportColumn::make('fax_number_1_ext'),
            ExportColumn::make('fax_number_2'),
            ExportColumn::make('handphone_number_1'),
            ExportColumn::make('handphone_number_2'),
            ExportColumn::make('email'),
            ExportColumn::make('country_id'),
            ExportColumn::make('provinsi_id'),
            ExportColumn::make('kabupaten_id'),
            ExportColumn::make('kecamatan_id'),
            ExportColumn::make('kelurahan_id'),
            ExportColumn::make('kodepos_id'),
            ExportColumn::make('kodepos'),
            ExportColumn::make('alamat'),
            ExportColumn::make('rt'),
            ExportColumn::make('rw'),
            ExportColumn::make('city'),
            ExportColumn::make('district'),
            ExportColumn::make('postal_code'),
            ExportColumn::make('region'),
            ExportColumn::make('po_box'),
            ExportColumn::make('street'),
            ExportColumn::make('building_number'),
            ExportColumn::make('floor'),
            ExportColumn::make('room'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your business partner export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
