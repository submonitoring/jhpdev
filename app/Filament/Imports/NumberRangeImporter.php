<?php

namespace App\Filament\Imports;

use App\Models\NumberRange;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class NumberRangeImporter extends Importer
{
    protected static ?string $model = NumberRange::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nr_object_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('number_range_interval')
                ->rules(['max:255']),
            ImportColumn::make('number_range_name')
                ->rules(['max:255']),
            ImportColumn::make('year')
                ->rules(['max:255']),
            ImportColumn::make('number')
                ->rules(['max:255']),
            ImportColumn::make('current_number')
                ->rules(['max:255']),
            ImportColumn::make('is_external')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('con')
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

    public function resolveRecord(): ?NumberRange
    {
        // return NumberRange::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new NumberRange();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your number range import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
