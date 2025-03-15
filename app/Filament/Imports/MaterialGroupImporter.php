<?php

namespace App\Filament\Imports;

use App\Models\MaterialGroup;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MaterialGroupImporter extends Importer
{
    protected static ?string $model = MaterialGroup::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('material_group')
                ->rules(['max:255']),
            ImportColumn::make('material_group_desc')
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

    public function resolveRecord(): ?MaterialGroup
    {
        // return MaterialGroup::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new MaterialGroup();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your material group import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
