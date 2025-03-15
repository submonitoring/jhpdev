<?php

namespace App\Filament\Imports;

use App\Models\MaterialMasterSales;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MaterialMasterSalesImporter extends Importer
{
    protected static ?string $model = MaterialMasterSales::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('material_master_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('sales_organization_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('distribution_channel_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('division_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('account_assignment_group_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('tax_classification_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('plant_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('material_group_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?MaterialMasterSales
    {
        // return MaterialMasterSales::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new MaterialMasterSales();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your material master sales import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
