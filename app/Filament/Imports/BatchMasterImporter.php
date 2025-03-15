<?php

namespace App\Filament\Imports;

use App\Models\BatchMaster;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class BatchMasterImporter extends Importer
{
    protected static ?string $model = BatchMaster::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('batch_source_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('number_range_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('batch_number')
                ->rules(['max:255']),
            ImportColumn::make('business_partner_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('production_date')
                ->rules(['date']),
            ImportColumn::make('expiration_date')
                ->rules(['date']),
            ImportColumn::make('is_external')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?BatchMaster
    {
        // return BatchMaster::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new BatchMaster();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your batch master import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
