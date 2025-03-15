<?php

namespace App\Filament\Imports;

use App\Models\ModuleActivityType;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ModuleActivityTypeImporter extends Importer
{
    protected static ?string $model = ModuleActivityType::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('module_activity_type')
                ->rules(['max:255']),
            ImportColumn::make('module_activity_type_name')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?ModuleActivityType
    {
        // return ModuleActivityType::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new ModuleActivityType();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your module activity type import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
