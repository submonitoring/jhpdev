<?php

namespace App\Filament\Imports;

use App\Models\BusinessPartner;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class BusinessPartnerImporter extends Importer
{
    protected static ?string $model = BusinessPartner::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('number_range_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('bp_number')
                ->rules(['max:255']),
            ImportColumn::make('bp_category_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('bp_role_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('vat_number')
                ->rules(['max:255']),
            ImportColumn::make('title_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('name_1')
                ->rules(['max:255']),
            ImportColumn::make('name_2')
                ->rules(['max:255']),
            ImportColumn::make('name_3')
                ->rules(['max:255']),
            ImportColumn::make('name_4')
                ->rules(['max:255']),
            ImportColumn::make('search_term')
                ->rules(['max:255']),
            ImportColumn::make('search_term2')
                ->rules(['max:255']),
            ImportColumn::make('telephone_number_1')
                ->rules(['max:255']),
            ImportColumn::make('telephone_number_1_ext')
                ->rules(['max:255']),
            ImportColumn::make('telephone_number_2')
                ->rules(['max:255']),
            ImportColumn::make('telephone_number_2_ext')
                ->rules(['max:255']),
            ImportColumn::make('fax_number_1')
                ->rules(['max:255']),
            ImportColumn::make('fax_number_1_ext')
                ->rules(['max:255']),
            ImportColumn::make('fax_number_2')
                ->rules(['max:255']),
            ImportColumn::make('handphone_number_1')
                ->rules(['max:255']),
            ImportColumn::make('handphone_number_2')
                ->rules(['max:255']),
            ImportColumn::make('email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('country_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('provinsi_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('kabupaten_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('kecamatan_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('kelurahan_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('kodepos_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('kodepos')
                ->rules(['max:255']),
            ImportColumn::make('alamat'),
            ImportColumn::make('rt')
                ->rules(['max:255']),
            ImportColumn::make('rw')
                ->rules(['max:255']),
            ImportColumn::make('city')
                ->rules(['max:255']),
            ImportColumn::make('district')
                ->rules(['max:255']),
            ImportColumn::make('postal_code')
                ->rules(['max:255']),
            ImportColumn::make('region')
                ->rules(['max:255']),
            ImportColumn::make('po_box')
                ->rules(['max:255']),
            ImportColumn::make('street'),
            ImportColumn::make('building_number')
                ->rules(['max:255']),
            ImportColumn::make('floor')
                ->rules(['max:255']),
            ImportColumn::make('room')
                ->rules(['max:255']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?BusinessPartner
    {
        // return BusinessPartner::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new BusinessPartner();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your business partner import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
