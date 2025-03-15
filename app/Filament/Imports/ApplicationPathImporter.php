<?php

namespace App\Filament\Imports;

use App\Models\ApplicationPath;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ApplicationPathImporter extends Importer
{
    protected static ?string $model = ApplicationPath::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('application_name_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('module_aaa_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('module_baa_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('module_caa_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('module_activity_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('module_activity_id')
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

    public function resolveRecord(): ?ApplicationPath
    {
        // return ApplicationPath::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new ApplicationPath();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your application path import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
