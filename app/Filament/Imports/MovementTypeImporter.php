<?php

namespace App\Filament\Imports;

use App\Models\MovementType;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MovementTypeImporter extends Importer
{
    protected static ?string $model = MovementType::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('movement_type')
                ->rules(['max:255']),
            ImportColumn::make('movement_type_desc')
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

    public function resolveRecord(): ?MovementType
    {
        // return MovementType::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new MovementType();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your movement type import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
