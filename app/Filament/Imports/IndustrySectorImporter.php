<?php

namespace App\Filament\Imports;

use App\Models\IndustrySector;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class IndustrySectorImporter extends Importer
{
    protected static ?string $model = IndustrySector::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('industry_sector')
                ->rules(['max:255']),
            ImportColumn::make('industry_sector_desc')
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

    public function resolveRecord(): ?IndustrySector
    {
        // return IndustrySector::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new IndustrySector();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your industry sector import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
