<?php

namespace App\Filament\Imports;

use App\Models\SalesAreaSalesOffice;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SalesAreaSalesOfficeImporter extends Importer
{
    protected static ?string $model = SalesAreaSalesOffice::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('sales_area_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('sales_office_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('isactive')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?SalesAreaSalesOffice
    {
        // return SalesAreaSalesOffice::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new SalesAreaSalesOffice();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your sales area sales office import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
