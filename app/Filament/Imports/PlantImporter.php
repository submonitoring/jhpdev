<?php

namespace App\Filament\Imports;

use App\Models\Plant;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class PlantImporter extends Importer
{
    protected static ?string $model = Plant::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('plant')
                ->rules(['max:255']),
            ImportColumn::make('plant_name')
                ->rules(['max:255']),
            ImportColumn::make('company_code_id')
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

    public function resolveRecord(): ?Plant
    {
        // return Plant::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Plant();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your plant import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
