<?php

namespace App\Filament\Imports;

use App\Models\ItemCategory;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ItemCategoryImporter extends Importer
{
    protected static ?string $model = ItemCategory::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('item_category')
                ->rules(['max:255']),
            ImportColumn::make('item_category_desc')
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

    public function resolveRecord(): ?ItemCategory
    {
        // return ItemCategory::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new ItemCategory();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your item category import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
