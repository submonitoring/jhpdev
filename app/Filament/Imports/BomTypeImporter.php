<?php

namespace App\Filament\Imports;

use App\Models\BomType;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class BomTypeImporter extends Importer
{
    protected static ?string $model = BomType::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('unique')
                ->rules(['max:26']),
            ImportColumn::make('record_title')
                ->rules(['max:255']),
            ImportColumn::make('bom_type')
                ->rules(['max:255']),
            ImportColumn::make('bom_type_desc')
                ->rules(['max:255']),
            ImportColumn::make('number_range_id')
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

    public function resolveRecord(): ?BomType
    {
        // return BomType::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new BomType();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your bom type import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
