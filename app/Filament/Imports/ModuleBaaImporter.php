<?php

namespace App\Filament\Imports;

use App\Models\ModuleBaa;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ModuleBaaImporter extends Importer
{
    protected static ?string $model = ModuleBaa::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('module_baa')
                ->rules(['max:255']),
            ImportColumn::make('module_baa_name')
                ->rules(['max:255']),
            ImportColumn::make('module_aaa_id')
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

    public function resolveRecord(): ?ModuleBaa
    {
        // return ModuleBaa::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new ModuleBaa();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your module baa import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
