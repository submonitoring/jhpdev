<?php

namespace App\Filament\Imports;

use App\Models\StorageLocation;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StorageLocationImporter extends Importer
{
    protected static ?string $model = StorageLocation::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('storage_location')
                ->rules(['max:255']),
            ImportColumn::make('storage_location_name')
                ->rules(['max:255']),
            ImportColumn::make('plant_id')
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

    public function resolveRecord(): ?StorageLocation
    {
        // return StorageLocation::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new StorageLocation();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your storage location import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
